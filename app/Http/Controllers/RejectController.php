<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Pages\reject\UpdateRequest;
use App\Services\PaymentTypeService;
use App\Services\CustomerService;
use App\Services\CmsLogService;
use App\Services\RejectService;
use App\Http\Requests\Pages\reject\CreateRequest;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Carbon\Carbon;

class RejectController extends Controller
{
    private $request;
    private $rejectService;
    private $cmsLogService;
    private $paymentTypeService;
    private $customerService;

    public function __construct(Request $request, RejectService $rejectService, CmsLogService $cmsLogService,PaymentTypeService $paymentTypeService,CustomerService $customerService)
    {
        $this->rejectService = $rejectService;
        $this->request = $request;
        $this->cmsLogService = $cmsLogService;
        $this->PaymentTypeService = $paymentTypeService;
        $this->CustomerService = $customerService;
    }

    public function index()
    {
        $items = $this->rejectService->datatable($this->request);

        return view('contents.reject.index',compact('items'));
    }
    public function create()
    {
        $PaymentType = $this->PaymentTypeService->all($this->request);
        $customers = $this->CustomerService->all($this->request);

        return view('contents.reject.create',compact('PaymentType','customers'));
    }

    public function store(CreateRequest $createRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $createRequest->handle();
            $this->rejectService->store($data);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menambahkan reject']);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('reject.index')->with('success', __('global.store_success_notification'));
        
    }

    public function edit($id)
    {
        $item = $this->rejectService->getById($id);
        $PaymentType = $this->PaymentTypeService->all($this->request);
        $customers = $this->CustomerService->all($this->request);

        return view('contents.reject.edit',compact('item','PaymentType','customers'));
    }

    public function update($id,UpdateRequest $updateRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $updateRequest->handle();
            $this->rejectService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Mengubah reject Dengan ID '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('reject.index')->with('success', __('global.update_success_notification'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try
        {
            $item = $this->rejectService->getById($id);

            $this->rejectService->destroy($id);

            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menghapus reject Dengan ID '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('reject.index')->with('success', __('global.destroy_success_notification'));
    }
}
