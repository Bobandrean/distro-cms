<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pages\PurchaseOrder\RejectRequest;
use App\Services\CmsLogService;
use App\Services\CustomerService;
use App\Services\DeliveryOrderService;
use App\Services\PaymentTypeCustomerService;
use App\Services\PaymentTypeService;
use App\Services\StockService;
use App\Services\SupplierService;
use Illuminate\Http\Request;
use App\Services\PurchaseOrderService;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Carbon\Carbon;

class PurchaseOrderController extends Controller
{
    private $purchaseOrderService;
    private $paymentTypeService;
    private $request;
    private $customerService;
    private $supplierService;
    private $cmsLogService;
    private $paymentTypeCustomerService;
    private $stockService;
    private $deliveryOrderService;

    public function __construct(
        Request $request, PurchaseOrderService $purchaseOrderService,PaymentTypeService $paymentTypeService,
        CustomerService $customerService, SupplierService $supplierService, CmsLogService $cmsLogService,
        PaymentTypeCustomerService $paymentTypeCustomerService, StockService $stockService, DeliveryOrderService $deliveryOrderService
    )
    {
        $this->purchaseOrderService = $purchaseOrderService;
        $this->paymentTypeService = $paymentTypeService;
        $this->request = $request;
        $this->customerService = $customerService;
        $this->supplierService = $supplierService;
        $this->cmsLogService = $cmsLogService;
        $this->paymentTypeCustomerService = $paymentTypeCustomerService;
        $this->stockService = $stockService;
        $this->deliveryOrderService = $deliveryOrderService;
    }

    public function index()
    {
        $items = $this->purchaseOrderService->datatable($this->request);
        $paymentTypes = $this->paymentTypeService->all();
        $request = $this->request;
        $customers = $this->customerService->all();
        $suppliers = $this->supplierService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.purchase-order.index',compact('items', 'request', 'paymentTypes', 'customers', 'suppliers'));
    }

    public function view($id)
    {
        $item = $this->purchaseOrderService->getByIdWith($id);

        return view('contents.purchase-order.view',compact('item'));
    }

    public function print($id)
    {
        $item = $this->purchaseOrderService->getByIdWith($id);

        $pdf = PDF::loadView('contents.purchase-order.pdf', compact('item'));

        return $pdf->download('invoice.pdf');
    }

    public function print_billing($id)
    {
        $item = $this->purchaseOrderService->getByIdWith($id);

        $pdf = PDF::loadView('contents.purchase-order.billing-pdf', compact('item'));

        return $pdf->download('po.pdf');
    }

    public function export()
    {
        $rows = $this->purchaseOrderService->export($this->request);


        foreach($rows as $row):
            $data[] = [
                __('pages/purchase-order.table.col_1') => Carbon::parse($row->tanggal)->format('Y-m-d'),
                __('pages/purchase-order.table.col_2') => $row->kode_po,
                __('pages/purchase-order.table.col_3') => $row->pembeli->nama_usaha,
                __('pages/purchase-order.table.col_4') => $row->pemasok->nama_perusahaan,
                __('pages/purchase-order.table.col_5') => $row->tipe_pembayaran->nama,
                __('pages/purchase-order.table.col_6') => $row->po_detail->lama_pinjaman . ' hari',
                __('pages/purchase-order.table.col_7') => $row->subtotal,
                __('pages/purchase-order.table.col_8') => $row->status_po,
                __('pages/purchase-order.table.col_9') => $row->po_detail->status_pelunasan,
            ];
        endforeach;

        return FastExcel::data($data)->download('purchase_order_'.Carbon::now()->format('Ymd').'.xlsx');
    }

    public function approve($id)
    {
        DB::beginTransaction();

        try
        {
            $item = $this->purchaseOrderService->getByIdWith($id);
            $credit = $this->paymentTypeCustomerService->getCreditInfo($item->id_pembeli, $item->id_pembayaran);

            if ($item->status_po == 'Menunggu'):
                // check available balance
                if ($credit->sisa_plafon >= $item->subtotal):
                    $data['status_po'] = 'Diterima_Pemasok';
                    $this->purchaseOrderService->update($id, $data);
                    $this->cmsLogService->store(['log' => session()->get('user')->username . ' Menerima Transaksi dengan ID PO ' . $id]);
                else:
                    return back()->with('error', __('global.credit_insufficient_notification'));
                endif;
            elseif ($item->status_po == 'Diterima_Pemasok'):
                // check available balance
                if ($credit->sisa_plafon >= $item->subtotal):
                    // check stock available
                    foreach($item->po_barang as $detail):
                        $stock = $this->stockService->getByProductId($detail->id_produk);
                        $availableStock = (int)$stock->jumlah_stok - (int)$stock->stok_minimum;
                        // update stock
                        if ($availableStock < $detail->jumlah):
                            return back()->with('error', __('global.stock_insufficient_notification'));
                        else:
                            $stock_data['jumlah_stok'] = (int)$stock->jumlah_stok - (int)$detail->jumlah;
                            $this->stockService->update($stock->id, $stock_data);
                        endif;
                    endforeach;

                    // create DO
                    $do_data['id_po'] = $id;
                    $do_data['tanggal'] = Carbon::now();
                    $do_data['kode_do'] = 'DO-' . Carbon::now()->format('Ymd') . '.' . rand(111111,999999);
                    $do_data['status_do'] = 'Diproses';
                    $do_data['foto_bukti_pengiriman'] = null;
                    $do_data['foto_invoice'] = null;
                    $this->deliveryOrderService->store($do_data);

                    // update customer's credit balance
                    $credit_data['sisa_plafon'] = (double)$credit->sisa_plafon - (double)$item->subtotal;
                    $this->paymentTypeCustomerService->update($credit->id, $credit_data);

                    // update PO status
                    $data['status_po'] = 'Diterima_Gudang';
                    $this->purchaseOrderService->update($id, $data);
                    $this->cmsLogService->store(['log' => session()->get('user')->username . ' Menerima Transaksi dengan ID PO ' . $id]);
                else:
                    return back()->with('error', __('global.credit_insufficient_notification'));
                endif;
            endif;
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return redirect()->route('purchase-order.index')->with('success', __('global.accept_notification'));
    }

    public function reject($id, RejectRequest $rejectRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $rejectRequest->handle();
            $this->purchaseOrderService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Membatalkan Transaksi dengan ID PO ' . $id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return redirect()->route('purchase-order.index')->with('success', __('global.reject_notification'));
    }
}
