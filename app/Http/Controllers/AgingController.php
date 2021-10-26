<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PurchaseOrderService;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class AgingController extends Controller
{
    private $purchaseOrderService;
    private $request;

    public function __construct(Request $request, PurchaseOrderService $purchaseOrderService)
    {
        $this->purchaseOrderService = $purchaseOrderService;
        $this->request = $request;
    }

    public function index()
    {
        $items = $this->purchaseOrderService->agingDatatable($this->request);

        $request = $this->request;

        if (isset($this->request->year) && !empty($this->request->year)):
            $year = $this->request->year;
        else:
            $year = Carbon::now()->format('Y');
        endif;

        return view('contents.aging.index',compact('items', 'request', 'year'));
    }

    public function view($year,$month)
    {
        $items = $this->purchaseOrderService->AgingDetail($year,$month);

        return view('contents.aging.view',compact('items'));
    }

    public function print($id)
    {
        $item = $this->purchaseOrderService->getByIdWith($id);

        $pdf = PDF::loadView('contents.aging.pdf', compact('item'));

        return $pdf->download('invoice.pdf');
    }

}
