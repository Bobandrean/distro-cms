<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Services\PaymentTypeService;
use App\Services\PurchaseOrderService;
use App\Services\SupplierService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class PendingDisbursementController extends Controller
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
        $items = $this->purchaseOrderService->pendingDisbursementDatatable($this->request);
        $request = $this->request;
        $suppliers = $this->supplierService->all();
        $customers = $this->customerService->all();
        $paymentTypes = $this->paymentTypeService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.pending-disbursement.index', compact(
            'items', 'request', 'suppliers', 'customers', 'paymentTypes'
        ));
    }

    public function export()
    {
        $rows = $this->purchaseOrderService->exportPendingDisbursementDatatable($this->request);

        foreach($rows as $row):

            if($row->po_detail->tanggal_pencairan != null):
                $tanggal_pencairan = Carbon::parse($row->po_detail->tanggal_pencairan)->format('Y-m-d');
            else:
                $tanggal_pencairan = '';
            endif;

            if($row->po_detail->jatuh_tempo != null):
                $jatuh_tempo = Carbon::parse($row->po_detail->jatuh_tempo)->format('Y-m-d');
            else:
                $jatuh_tempo = '';
            endif;

            $data[] = [
                __('pages/pending-disbursement.table.col_2') => $row->kode_po,
                __('pages/pending-disbursement.table.col_4') => $row->pembeli->nama_usaha,
                __('pages/pending-disbursement.table.col_5') => $row->pemasok->nama_perusahaan,
                __('pages/pending-disbursement.table.col_6') => $row->tipe_pembayaran->nama,
                __('pages/pending-disbursement.table.col_7') => $row->po_detail->lama_pinjaman.' hari',
                __('pages/pending-disbursement.table.col_13') => $row->nilai_pencairan,
                __('pages/pending-disbursement.table.col_9') => $row->biaya_layanan,
                __('pages/pending-disbursement.table.col_10') => $row->biaya_bunga,
                __('pages/pending-disbursement.table.col_11') => $row->nilai_pelunasan
            ];
        endforeach;

        return FastExcel::data($data)->download('pending_disbursements_'.Carbon::now()->format('Ymd').'.xlsx');
    }
}
