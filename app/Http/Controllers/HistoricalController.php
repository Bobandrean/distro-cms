<?php

namespace App\Http\Controllers;

use App\Services\CmsLogService;
use App\Services\CustomerService;
use App\Services\DeliveryOrderService;
use App\Services\PaymentTypeCustomerService;
use App\Services\PaymentTypeService;
use App\Services\PurchaseOrderService;
use App\Services\StockService;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class HistoricalController extends Controller
{
    private $purchaseOrderService;
    private $request;

    public function __construct(Request $request, PurchaseOrderService $purchaseOrderService)
    {
        $this->purchaseOrderService = $purchaseOrderService;
        $this->request = $request;
    }

    public function index($customer_id)
    {
        $request = $this->request;
        $items = $this->purchaseOrderService->datatableByCustomerId($customer_id);

        return view('contents.historical.index',compact('items', 'request', 'customer_id'));
    }

    public function view($customer_id, $po_id)
    {
        $item = $this->purchaseOrderService->getByIdWith($po_id);

        return view('contents.historical.view',compact('item'));
    }
}
