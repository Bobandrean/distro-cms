<?php

namespace App\Http\Controllers;

use App\Services\PurchaseOrderService;
use App\Services\SupplierService;
use App\Services\CustomerService;
use App\Services\PaymentTypeService;


use Illuminate\Http\Request;

class TotalOverDueController extends Controller
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
        $items = $this->purchaseOrderService->totalOverDueDatatable($this->request);   
        $request = $this->request;
        $suppliers = $this->supplierService->all();
        $customers = $this->customerService->all();
        $paymentTypes = $this->paymentTypeService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.overdue.index',compact('items','request','suppliers','customers','paymentTypes'));
    }
}
