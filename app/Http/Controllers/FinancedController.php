<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Services\PaymentTypeService;
use App\Services\PurchaseOrderService;
use App\Services\SupplierService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class FinancedController extends Controller
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
        $items = $this->purchaseOrderService->financedDatatable($this->request);
        $request = $this->request;
        $suppliers = $this->supplierService->all();
        $customers = $this->customerService->all();
        $paymentTypes = $this->paymentTypeService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.financed.index', compact(
            'items', 'request', 'suppliers', 'customers', 'paymentTypes'
        ));
    }

    public function export()
    {
        $rows = $this->purchaseOrderService->exportfinancedDatatable($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/financed.table.col_2') => $row->kode_po,
                __('pages/financed.table.col_4') => $row->pembeli->nama_usaha,
                __('pages/financed.table.col_5') => $row->pemasok->nama_perusahaan ,
                __('pages/financed.table.col_6') => $row->tipe_pembayaran->nama,
                __('pages/financed.table.col_7') => $row->po_detail->lama_pinjaman.' hari',
                __('pages/financed.table.col_8') => $row->subtotal,
                __('pages/financed.table.col_9') => $row->biaya_layanan,
                __('pages/financed.table.col_10') => $row->biaya_bunga,
                __('pages/financed.table.col_11') => $row->total,
                __('pages/financed.table.col_1') => Carbon::parse($row->tanggal)->format('Y-m-d'),
                __('pages/financed.table.col_12') => Carbon::parse($row->tanggal)->format('Y-m-d'),
            ];
        endforeach;

        return FastExcel::data($data)->download('financed_'.Carbon::now()->format('Ymd').'.xlsx');
    }
}
