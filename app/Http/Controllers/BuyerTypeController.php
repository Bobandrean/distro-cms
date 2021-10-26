<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pages\BuyerType\CreateRequest;
use App\Http\Requests\Pages\BuyerType\UpdateRequest;
use App\Services\CmsLogService;
use App\Services\SupplierService;
use Illuminate\Http\Request;
use App\Services\BuyerTypeService;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Carbon\Carbon;


class BuyerTypeController extends Controller
{
    private $buyerTypeService;
    private $request;
    private $cmsLogService;
    private $supplierService;

    public function __construct(BuyerTypeService $buyerTypeService, Request $request, CmsLogService $cmsLogService, SupplierService $supplierService)
    {
        $this->buyerTypeService = $buyerTypeService;
        $this->request = $request;
        $this->cmsLogService = $cmsLogService;
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        $items = $this->buyerTypeService->datatable($this->request);

        $request = $this->request;

        $suppliers = $this->supplierService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.buyer-type.index',compact('request','items', 'suppliers'));
    }

    public function export()
    {
        $rows = $this->buyerTypeService->export($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/buyer_type.table.col_1') => $row->pemasok->nama_perusahaan . '(' . $row->pemasok->nama_pic . ')',
                __('pages/buyer_type.table.col_2') => $row->nama,
                __('pages/buyer_type.table.col_3') => strip_tags($row->keterangan)
            ];
        endforeach;

        return FastExcel::data($data)->download('Tipe_pembeli_'.Carbon::now()->format('Ymd').'.xlsx');
    }

    public function create()
    {
        return view('contents.buyer-type.create');
    }

    public function store(CreateRequest $createRequest)
    {
        DB::beginTransaction();

        try {
            $data = $createRequest->handle();
            $this->buyerTypeService->store($data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Menambahkan Tipe Pembeli Baru.']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return redirect()->route('buyer-type.index')->with('success', __('global.store_success_notification'));
    }

    public function edit($id)
    {
        $item = $this->buyerTypeService->getById($id);

        return view('contents.buyer-type.edit',compact('item'));
    }

    public function update($id, UpdateRequest $updateRequest)
    {
        DB::beginTransaction();

        try {
            $data = $updateRequest->handle();
            $this->buyerTypeService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengubah Tipe Pembeli Dengan ID ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return redirect()->route('buyer-type.index')->with('success', __('global.update_success_notification'));
    }
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $this->buyerTypeService->destroy($id);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Menghapus Tipe Pembeli Dengan ID ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return redirect()->route('buyer-type.index')->with('success', __('global.destroy_success_notification'));
    }
}
