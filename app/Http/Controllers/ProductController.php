<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pages\Product\CreateRequest;
use App\Http\Requests\Pages\Product\UpdateRequest;
use App\Models\PriceCatalogue;
use App\Services\CmsLogService;
use App\Services\MeasurementService;
use App\Services\PackagingService;
use App\Services\PriceCatalogueService;
use App\Services\ProductCategoryService;
use App\Services\ProductService;
use App\Services\SupplierService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class ProductController extends Controller
{
    private $request;
    private $productService;
    private $supplierService;
    private $productCategoryService;
    private $measurementService;
    private $packagingService;
    private $cmsLogService;
    private $priceCatalogueService;

    public function __construct(Request $request, ProductService $productService, SupplierService $supplierService,
                                ProductCategoryService $productCategoryService, MeasurementService $measurementService, PackagingService $packagingService,
                                CmsLogService $cmsLogService, PriceCatalogueService $priceCatalogueService)
    {
        $this->request = $request;
        $this->productService = $productService;
        $this->supplierService = $supplierService;
        $this->productCategoryService = $productCategoryService;
        $this->measurementService = $measurementService;
        $this->packagingService = $packagingService;
        $this->cmsLogService = $cmsLogService;
        $this->priceCatalogueService = $priceCatalogueService;
    }

    public function index()
    {
        $items = $this->productService->datatable($this->request);
        $trashedItems = $this->productService->datatableOnlyTrashed($this->request);
        $request = $this->request;
        $suppliers = $this->supplierService->all();
        $productCategories = $this->productCategoryService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.product.index', compact('request', 'items', 'trashedItems', 'suppliers', 'productCategories'));
    }

    public function export()
    {
        $rows = $this->productService->export($this->request);

        foreach ($rows as $row):
            $data[] = [
                __('pages/product.table.col_2') => $row->pemasok->nama_perusahaan . '(' . $row->pemasok->nama_pic . ')',
                __('pages/product.table.col_3') => $row->kategori_produk->nama,
                __('pages/product.table.col_4') => $row->kode,
                __('pages/product.table.col_5') => $row->nama,
                __('pages/product.table.col_6') => $row->ppn,
                __('pages/product.table.col_7') => $row->harga_dasar,
                __('pages/product.table.col_8') => $row->harga
            ];
        endforeach;

        return FastExcel::data($data)->download('product_' . Carbon::now()->format('Ymd') . '.xlsx');
    }

    public function create()
    {
        $productCategories = $this->productCategoryService->all();
        $measurements = $this->measurementService->all();
        $packagings = $this->packagingService->all();

        return view('contents.product.create', compact('productCategories', 'measurements', 'packagings'));
    }

    public function store(CreateRequest $createRequest)
    {
        DB::beginTransaction();

        try {
            $data = $createRequest->handle();
            $this->productService->store($data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Menambahkan Produk Baru.']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return redirect()->route('product.index')->with('success', __('global.store_success_notification'));
    }

    public function edit($id)
    {
        $item = $this->productService->getById($id);
        $productCategories = $this->productCategoryService->all();
        $measurements = $this->measurementService->all();
        $packagings = $this->packagingService->all();

        return view('contents.product.edit', compact('item', 'productCategories', 'measurements', 'packagings'));
    }

    public function update($id, UpdateRequest $updateRequest)
    {
        DB::beginTransaction();

        try {
            $data = $updateRequest->handle();
            $this->productService->update($id, $data);
            $this->priceCatalogueService->updateByProductId($id, $data['harga']);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengubah Produk Dengan ID Produk ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('product.index')->with('success', __('global.update_success_notification'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $data['hapus'] = '1';
            $this->productService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Menghapus Produk Dengan ID Produk ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('product.index')->with('success', __('global.destroy_success_notification'));
    }

    public function restore($id)
    {
        DB::beginTransaction();

        try {
            $data['hapus'] = '0';
            $this->productService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengembalikan Produk Dengan ID Produk ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('product.index')->with('success', __('global.restore_success_notification'));
    }
}
