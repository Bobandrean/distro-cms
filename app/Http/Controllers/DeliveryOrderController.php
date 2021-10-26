<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pages\DeliveryOrder\FinishRequest;
use App\Services\CmsLogService;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use App\Services\DeliveryOrderService;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Carbon\Carbon;

class DeliveryOrderController extends Controller
{
    private $request;
    private $deliveryOrderService;
    private $customerService;
    private $cmsLogService;

    public function __construct(Request $request, DeliveryOrderService $deliveryOrderService, CustomerService $customerService, CmsLogService $cmsLogService)
    {
        $this->deliveryOrderService = $deliveryOrderService;
        $this->request = $request;
        $this->customerService = $customerService;
        $this->cmsLogService = $cmsLogService;
    }

    public function index()
    {
        $items = $this->deliveryOrderService->datatable($this->request);

        $request = $this->request;


        if ($this->request->export == '1'):
            return $this->export();
        endif;

        $customers = $this->customerService->all();

        return view('contents.delivery-order.index', compact('items', 'request', 'customers'));
    }

    public function view($id)
    {
        $item = $this->deliveryOrderService->getByIdWith($id);
        return view('contents.delivery-order.view', compact('item'));
    }

    public function print($id)
    {
        $item = $this->deliveryOrderService->getByIdWith($id);

        $pdf = PDF::loadView('contents.delivery-order.pdf', compact('item'));
        return $pdf->download('invoice_pengiriman_produk.pdf');
    }

    public function export()
    {
        $rows = $this->deliveryOrderService->export($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/delivery-order.table.col_1') => Carbon::parse($row->tanggal)->format('Y-m-d'),
                __('pages/delivery-order.table.col_2') => $row->kode_do,
                __('pages/delivery-order.table.col_3') => $row->po->kode_po,
                __('pages/delivery-order.table.col_4') => $row->po->pembeli->nama_usaha . '(' . $row->po->pembeli->nama_depan . ' ' . $row->po->pembeli->nama_belakang . ')',
                __('pages/delivery-order.table.col_5') => $row->status_do,
            ];
        endforeach;

        return FastExcel::data($data)->download('delivery_order_'.Carbon::now()->format('Ymd').'.xlsx');
    }

    public function onDelivery($id)
    {
        DB::beginTransaction();

        try
        {
            $data['status_do'] = 'Dalam Pengiriman';
            $this->deliveryOrderService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengubah Status Transaksi dengan ID DO ' . $id . ' menjadi Dalam Pengiriman']);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('delivery-order.index')->with('success', __('global.update_success_notification'));
    }

    public function finish($id, FinishRequest $finishRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $finishRequest->handle();
            $this->deliveryOrderService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengubah Status Transaksi dengan ID DO ' . $id . ' menjadi Selesai']);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('delivery-order.index')->with('success', __('global.update_success_notification'));
    }
}
