<?php

namespace App\Http\Controllers;

use App\Services\PurchaseOrderService;
use App\Services\CustomerService;
use App\Services\SupplierService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class ActiveCustomerController extends Controller
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
        $items = $this->purchaseOrderService->activeCustomerDatatable($this->request);
        $request = $this->request;
        $customers = $this->customerService->all();
        $countCustomers = $this->customerService->getNumber($this->request);
        $getDataActiveCustomers = $this->purchaseOrderService->getDataActiveCustomers();

        $active = [];
        foreach($getDataActiveCustomers as $ac):
            array_push($active, $ac->id_pembeli);
        endforeach;
        // return $active;
        $getInactiveCustomer = $this->customerService->getInactiveCustomer($active);
            
        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.active-customer.index', compact(
            'items', 'request', 'customers', 'countCustomers', 'getDataActiveCustomers', 'getInactiveCustomer'
        ));
    }

    public function export()
    {
        $rows = $this->purchaseOrderService->exportActiveCustomerDatatable($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/active-customer.table_1.col_2') => $row->pembeli->nama_usaha,
                __('pages/active-customer.table_1.col_3') => $row->jumlah_transaksi,
                __('pages/active-customer.table_1.col_4') => $row->subtotal
            ];
        endforeach;

        return FastExcel::data($data)->download('active_distributor'.Carbon::now()->format('Ymd').'.xlsx');
    }
}
