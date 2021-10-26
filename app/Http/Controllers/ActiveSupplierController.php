<?php

namespace App\Http\Controllers;

use App\Services\PurchaseOrderService;
use App\Services\CustomerService;
use App\Services\SupplierService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class ActiveSupplierController extends Controller
{
    private $request;
    private $purchaseOrderService;
    private $customerService;
    private $supplierService;

    public function __construct(
        Request $request, PurchaseOrderService $purchaseOrderService, SupplierService $supplierService,
        CustomerService $customerService)
    {
        $this->request = $request;
        $this->purchaseOrderService = $purchaseOrderService;
        $this->customerService = $customerService;
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        $items = $this->purchaseOrderService->activeSupplierDatatable($this->request);
        $request = $this->request;
        $suppliers = $this->supplierService->all();
        $countSuppliers = $this->supplierService->getNumber($this->request);
        $getDataActivePrincipal = $this->purchaseOrderService->getDataActivePrincipal();

        $active = [];
        foreach($getDataActivePrincipal as $ac):
            array_push($active, $ac->id_pemasok);
        endforeach;

        $getInactiveSupplier = $this->supplierService->getInactiveSupplier($active);

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.active-supplier.index', compact(
            'items', 'request', 'suppliers', 'countSuppliers', 'getDataActivePrincipal', 'getInactiveSupplier'
        ));
    }

    public function export()
    {
        $rows = $this->purchaseOrderService->exportActiveSupplierDatatable($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/active-supplier.table_1.col_2') => $row->pemasok->nama_perusahaan,
                __('pages/active-supplier.table_1.col_3') => $row->jumlah_transaksi,
                __('pages/active-supplier.table_1.col_4') => $row->subtotal
            ];
        endforeach;

        return FastExcel::data($data)->download('active_principal'.Carbon::now()->format('Ymd').'.xlsx');
    }
}
