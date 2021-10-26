<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\Http\Request;
use App\Services\DeliveryOrderService;
use Barryvdh\DomPDF\Facade as PDF;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Carbon\Carbon;

class DeliveryOrderHistoryController extends Controller
{
    private $deliveryOrderService;
    private $request;
    private $customerService;

    public function __construct(Request $request, DeliveryOrderService $deliveryOrderService, CustomerService $customerService)
    {
        $this->deliveryOrderService = $deliveryOrderService;
        $this->request = $request;
        $this->customerService = $customerService;
    }

    public function index()
    {
        $items = $this->deliveryOrderService->datatableHistory($this->request);
        $request = $this->request;
        if ($this->request->export == '1'):
            return $this->export();
        endif;
        $customers = $this->customerService->all();

        return view('contents.delivery-order-history.index', compact('items', 'request', 'customers'));
    }

    public function printpdf($id)
    {
        $item = $this->deliveryOrderService->getByIdWith($id);

        $pdf = PDF::loadView('contents.delivery-order-history.pdf', compact('item'));
        return $pdf->download('invoicepengirimanproduk.pdf');
    }

    public function export()
    {
        $rows = $this->deliveryOrderService->exportHistory($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/delivery-order.table.col_1') => Carbon::parse($row->tanggal)->format('Y-m-d'),
                __('pages/delivery-order.table.col_2') => $row->kode_do,
                __('pages/delivery-order.table.col_3') => $row->po->kode_po,
                __('pages/delivery-order.table.col_4') => $row->po->pembeli->nama_usaha . '(' . $row->po->pembeli->nama_depan . ' ' . $row->po->pembeli->nama_belakang . ')',
                __('pages/delivery-order.table.col_5') => $row->status_do,
            ];
        endforeach;

        return FastExcel::data($data)->download('delivery_order_history_'.Carbon::now()->format('Ymd').'.xlsx');
    }
}
