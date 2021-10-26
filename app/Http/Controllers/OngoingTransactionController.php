<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Services\PaymentTypeService;
use App\Services\PurchaseOrderService;
use App\Services\SupplierService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class OngoingTransactionController extends Controller
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
        $items = $this->purchaseOrderService->ongoingTransactionDatatable($this->request);
        $request = $this->request;
        $suppliers = $this->supplierService->all();
        $customers = $this->customerService->all();
        $paymentTypes = $this->paymentTypeService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.ongoing-transaction.index', compact(
            'items', 'request', 'suppliers', 'customers', 'paymentTypes'
        ));
    }

    public function export()
    {
        $rows = $this->purchaseOrderService->exportOngoingTransactionDatatable($this->request);
        
        foreach($rows as $row):
            $data[] = [
                __('pages/ongoing-transaction.table.col_1') => Carbon::parse($row->tanggal)->format('Y-m-d'),
                __('pages/ongoing-transaction.table.col_2') => $row->kode_po,
                __('pages/ongoing-transaction.table.col_3') => $row->pembeli->nama_usaha,
                __('pages/ongoing-transaction.table.col_4') => $row->pemasok->nama_perusahaan,
                __('pages/ongoing-transaction.table.col_5') => $row->tipe_pembayaran->nama,
                __('pages/ongoing-transaction.table.col_6') => $row->po_detail->lama_pinjaman.' hari',
                __('pages/ongoing-transaction.table.col_7') => $row->subtotal,
                __('pages/ongoing-transaction.table.col_8') => $row->biaya_layanan,
                __('pages/ongoing-transaction.table.col_9') => $row->biaya_bunga,
                __('pages/ongoing-transaction.table.col_10') => $row->total
            ];
        endforeach;

        return FastExcel::data($data)->download('ongoing_transaction_'.Carbon::now()->format('Ymd').'.xlsx');
    }
}
