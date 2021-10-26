<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Services\PaymentTypeService;
use App\Services\PurchaseOrderService;
use App\Services\SupplierService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class NewOrderController extends Controller
{
    private $request;
    private $purchaseOrderService;
    private $supplierService;
    private $customerService;
    private $paymentTypeService;

    public function __construct(Request $request, PurchaseOrderService $purchaseOrderService, SupplierService $supplierService,
                                CustomerService $customerService, PaymentTypeService $paymentTypeService)
    {
        $this->request = $request;
        $this->purchaseOrderService = $purchaseOrderService;
        $this->supplierService = $supplierService;
        $this->customerService = $customerService;
        $this->paymentTypeService = $paymentTypeService;
    }

    public function index()
    {
        $request = $this->request;
        $items = $this->purchaseOrderService->newOrdersDatatable($this->request);
        $suppliers = $this->supplierService->all();
        $customers = $this->customerService->all();
        $paymentTypes = $this->paymentTypeService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.new-order.index', compact(
            'items', 'request', 'suppliers', 'customers', 'paymentTypes'
        ));
    }

    public function export()
    {
        $rows = $this->purchaseOrderService->exportNewOrdersDatatable($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/disbursement.table.col_1') => Carbon::parse($row->tanggal)->format('Y-m-d'),
                __('pages/disbursement.table.col_2') => $row->kode_po,
                __('pages/disbursement.table.col_3') => $row->pemasok->nama_perusahaan . '(' . $row->pemasok->nama_pic . ')',
                __('pages/disbursement.table.col_4') => $row->pembeli->nama_usaha . '(' . $row->pembeli->nama_depan . ' ' . $row->pembeli->nama_belakang . ')',
                __('pages/disbursement.table.col_5') => $row->tipe_pembayaran->nama,
                __('pages/disbursement.table.col_6') => $row->po_detail->lama_pinjaman.' hari',
                __('pages/disbursement.table.col_7') => $row->subtotal,
                __('pages/disbursement.table.col_8') => $row->biaya_layanan,
                __('pages/disbursement.table.col_9') => $row->biaya_bunga,
                __('pages/disbursement.table.col_10') => $row->total,
            ];
        endforeach;

        return FastExcel::data($data)->download('new_order_'.Carbon::now()->format('Ymd').'.xlsx');
    }
}
