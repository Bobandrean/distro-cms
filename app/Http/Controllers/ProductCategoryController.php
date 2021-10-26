<?php

namespace App\Http\Controllers;


use App\Http\Requests\Pages\ProductCategory\CreateRequest;
use App\Http\Requests\Pages\ProductCategory\UpdateRequest;
use App\Services\CmsLogService;
use Illuminate\Http\Request;
use App\Services\ProductCategoryService;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Carbon\Carbon;

class ProductCategoryController extends Controller
{
    private $productCategoryService;
    private $request;
    private $cmsLogService;

    public function __construct(Request $request, ProductCategoryService $productCategoryService, CmsLogService $cmsLogService)
    {
        $this->productCategoryService = $productCategoryService;
        $this->request = $request;
        $this->cmsLogService = $cmsLogService;
    }

    public function index()
    {
        $items = $this->productCategoryService->datatable($this->request);
        $trashedItems = $this->productCategoryService->datatableOnlyTrashed($this->request);

        $request = $this->request;

        if ($this->request->export == '1'):
            return $this->export();
        endif;


        return view('contents.product-category.index',compact('items','request','trashedItems'));
    }
    public function export()
    {
        $rows = $this->productCategoryService->export($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/product-category.table.col_1') => $row->nama,
                __('pages/product-category.table.col_2') => strip_tags($row->deskripsi),
                __('pages/product-category.table.col_3') => $row->ikon,
            ];
        endforeach;

        return FastExcel::data($data)->download('kategori_produk_'.Carbon::now()->format('Ymd').'.xlsx');
    }

    public function create()
    {
        return view('contents.product-category.create');
    }

    public function store(CreateRequest $createRequest)
    {
        DB::beginTransaction();

        try {
            $data = $createRequest->handle();
            $this->productCategoryService->store($data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Menambahkan Kategori Produk Baru.']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return redirect()->route('product-category.index')->with('success', __('global.store_success_notification'));
    }

    public function edit($id)
    {
        $item = $this->productCategoryService->getById($id);

        return view('contents.product-category.edit',compact('item'));

    }
    public function update($id, UpdateRequest $updateRequest)
    {
        DB::beginTransaction();

        try {
            $data = $updateRequest->handle();
            $this->productCategoryService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengubah Kategori Produk Dengan ID ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return redirect()->route('product-category.index')->with('success', __('global.update_success_notification'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $data['hapus'] = '1';
            $this->productCategoryService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Menghapus Kategori Produk Dengan ID ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return redirect()->route('product-category.index')->with('success', __('global.destroy_success_notification'));
    }

    public function restore($id)
    {
        DB::beginTransaction();

        try {
            $data['hapus'] = '0';
            $this->productCategoryService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengembalikan Kategori Produk Dengan ID ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('product-category.index')->with('success', __('global.restore_success_notification'));
    }
}
