<?php

namespace App\Http\Controllers;

use App\Services\BuyerTypeService;
use App\Services\CustomerService;
use App\Services\CustomerSupplierRelationService;
use App\Services\ProvinceService;
use App\Services\RegencyService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Services\CmsLogService;
use App\Services\SupplierService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Pages\Supplier\CreateRequest;
use App\Http\Requests\Pages\Supplier\UpdateRequest;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Carbon\Carbon;


class SupplierController extends Controller
{
    private $request;
    private $supplierService;
    private $cmsLogService;
    private $userService;
    private $provinceService;
    private $regencyService;
    private $customerSupplierRelationService;
    private $buyerTypeService;
    private $customerService;

    public function __construct(Request $request, SupplierService $supplierService, CmsLogService $cmsLogService, UserService $userService,
    ProvinceService $provinceService, RegencyService $regencyService, CustomerSupplierRelationService $customerSupplierRelationService,
    BuyerTypeService $buyerTypeService, CustomerService $customerService)
    {
        $this->supplierService = $supplierService;
        $this->request = $request;
        $this->cmsLogService = $cmsLogService;
        $this->userService = $userService;
        $this->provinceService = $provinceService;
        $this->regencyService = $regencyService;
        $this->customerSupplierRelationService = $customerSupplierRelationService;
        $this->buyerTypeService = $buyerTypeService;
        $this->customerService = $customerService;
    }

    public function index()
    {
        $items = $this->supplierService->datatable($this->request);

        $trashedItems = $this->supplierService->trashedOnlyDatatable($this->request);

        $request = $this->request;

        $provinces = $this->provinceService->all();
        $regencies = $this->regencyService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.supplier.index',compact('items','request', 'trashedItems', 'provinces', 'regencies'));
    }

    public function export()
    {
        $rows = $this->supplierService->export($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/supplier.table.col_1') => $row->users->username,
                __('pages/supplier.table.col_2') => $row->nama_perusahaan,
                __('pages/supplier.table.col_3') => $row->nama_pic,
                __('pages/supplier.table.col_4') => $row->email,
                __('pages/supplier.table.col_5') => $row->province->nama,
                __('pages/supplier.table.col_6') => $row->regency->nama
            ];
        endforeach;

        return FastExcel::data($data)->download('supplier_'.Carbon::now()->format('Ymd').'.xlsx');
    }

    public function create()
    {
        return view('contents.supplier.create');
    }

    public function store(CreateRequest $createRequest)
    {
        DB::beginTransaction();

        try
        {
            $createRequest->handle();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('supplier.index')->with('success', __('global.store_success_notification'));
    }

    public function edit($id)
    {
        $item = $this->supplierService->getById($id);

        return view('contents.supplier.edit',compact('item'));
    }

    public function update(UpdateRequest $updateRequest)
    {
        DB::beginTransaction();

        try
        {
            $updateRequest->handle();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('supplier.index')->with('success', __('global.update_success_notification'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try
        {
            $supplier = $this->supplierService->getById($id);
            $data['status'] = '0';
            $this->userService->update($supplier->id_user, $data);

            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menghapus Pemasok Dengan ID '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('supplier.index')->with('success', __('global.destroy_success_notification'));
    }

    public function restore($id)
    {
        DB::beginTransaction();

        try
        {
            $supplier = $this->supplierService->getById($id);
            $data['status'] = '1';
            $this->userService->update($supplier->id_user, $data);

            $this->cmsLogService->store(['log' => session()->get('user')->username.' Mengembalikan Pemasok Dengan ID '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('supplier.index')->with('success', __('global.restore_success_notification'));
    }

    public function distributors($id)
    {
        $request = $this->request;
        $items = $this->customerSupplierRelationService->getDistributorsbySupplierId($id, $this->request);
        $provinces = $this->provinceService->all();
        $regencies = $this->regencyService->all();
        $buyerTypes = $this->buyerTypeService->all();
        $distributors = $this->customerService->all();

        if ($this->request->export == '1'):
            return $this->exportDistributorsBySupplierId($id);
        endif;

        return view('contents.supplier.distributors', compact(
            'items', 'request', 'id', 'provinces', 'regencies', 'buyerTypes', 'distributors'
        ));
    }

    public function exportDistributorsBySupplierId($id)
    {
        $rows = $this->customerSupplierRelationService->exportDistributorsBySupplierId($id, $this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/supplier.distributors.table.col_1') => $row->pemasok->nama_perusahaan,
                __('pages/supplier.distributors.table.col_2') => $row->pembeli->nama_usaha . '(' .$row->pembeli->nama_depan . ' ' . $row->pembeli->nama_belakang .')',
                __('pages/supplier.distributors.table.col_3') => $row->tipe_pembeli->nama,
                __('pages/supplier.distributors.table.col_4') => $row->pembeli->province->nama,
                __('pages/supplier.distributors.table.col_5') => $row->pembeli->regency->nama
            ];
        endforeach;

        return FastExcel::data($data)->download('supplier_distributors_'.Carbon::now()->format('Ymd').'.xlsx');
    }
}
