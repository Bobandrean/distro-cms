<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Services\PaymentTypeService;
use App\Services\PurchaseOrderService;
use App\Services\SupplierService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class OutstandingController extends Controller
{
    private $request;
    private $purchaseOrderService;
    private $supplierService;
    private $customerService;
    private $paymentTypeService;

    public function __construct(
        Request $request, PurchaseOrderService $purchaseOrderService, SupplierService $supplierService,
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
        $items = $this->purchaseOrderService->totalOutstandingDatatable($this->request);
        $request = $this->request;
        $suppliers = $this->supplierService->all();
        $customers = $this->customerService->all();
        $paymentTypes = $this->paymentTypeService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.outstanding.index', compact(
            'items', 'request', 'suppliers', 'customers', 'paymentTypes'
        ));
    }

    public function export()
    {
        $rows = $this->purchaseOrderService->exportTotalOutstandingDatatable($this->request);
        if (session()->get('payment_id') != '0'):
            foreach($rows as $row):
                $data[] = [
                    __('pages/outstanding.table.col_1') => Carbon::parse($row->tanggal)->format('Y-m-d'),
                    __('pages/outstanding.table.col_2') => $row->kode_po,
                    __('pages/outstanding.table.col_3') => $row->do->kode_do,
                    __('pages/outstanding.table.col_4') => $row->pemasok->nama_perusahaan . '(' . $row->pemasok->nama_pic . ')',
                    __('pages/outstanding.table.col_5') => $row->pembeli->nama_usaha . '(' . $row->pembeli->nama_depan . ' ' . $row->pembeli->nama_belakang . ')',
                    __('pages/outstanding.table.col_6') => $row->tipe_pembayaran->nama,
                    __('pages/outstanding.table.col_7') => $row->po_detail->lama_pinjaman.' hari',
                    __('pages/outstanding.table.col_8') => $row->subtotal,
                    __('pages/outstanding.table.col_9') => $row->biaya_layanan,
                    __('pages/outstanding.table.col_10') => $row->biaya_bunga,
                    __('pages/outstanding.table.col_11') => $row->total,
                ];
            endforeach;

        else:
                foreach($rows as $row):
                    $data[] = [
                        __('pages/outstanding.table.col_1') => Carbon::parse($row->tanggal)->format('Y-m-d'),
                        __('pages/outstanding.table.col_2') => $row->kode_po,
                        __('pages/outstanding.table.col_3') => $row->do->kode_do,
                        __('pages/outstanding.table.col_4') => $row->pemasok->nama_perusahaan . '(' . $row->pemasok->nama_pic . ')',
                        __('pages/outstanding.table.col_5') => $row->pembeli->nama_usaha . '(' . $row->pembeli->nama_depan . ' ' . $row->pembeli->nama_belakang . ')',
                        __('pages/outstanding.table.col_6') => $row->tipe_pembayaran->nama,
                        __('pages/outstanding.table.col_7') => $row->po_detail->lama_pinjaman.' hari',
                        __('pages/outstanding.table.col_8') => $row->subtotal,
                        __('pages/outstanding.table.col_10') => $row->biaya_bunga,
                        __('pages/outstanding.table.col_11') => $row->total,
                    ];
                endforeach;
        endif;
     

        return FastExcel::data($data)->download('outstanding_'.Carbon::now()->format('Ymd').'.xlsx');
    }
}
