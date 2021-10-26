<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pages\PriceCatalogue\CreateRequest;
use App\Http\Requests\Pages\PriceCatalogue\UpdateRequest;
use App\Services\BuyerTypeService;
use App\Services\CmsLogService;
use App\Services\PriceCatalogueService;
use App\Services\ProductService;
use App\Services\SupplierService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class PriceCatalogueController extends Controller
{
    private $priceCatalogueService;
    private $request;
    private $supplierService;
    private $buyerTypeService;
    private $productService;
    private $cmsLogService;

    public function __construct(PriceCatalogueService $priceCatalogueService, Request $request,
                                SupplierService $supplierService, BuyerTypeService $buyerTypeService,
                                ProductService $productService, CmsLogService $cmsLogService)
    {
        $this->priceCatalogueService = $priceCatalogueService;
        $this->request = $request;
        $this->supplierService = $supplierService;
        $this->buyerTypeService = $buyerTypeService;
        $this->productService = $productService;
        $this->cmsLogService = $cmsLogService;
    }

    public function index()
    {
        $items = $this->priceCatalogueService->datatable($this->request);
        $request = $this->request;
        $suppliers = $this->supplierService->all();
        $buyerTypes = $this->buyerTypeService->all();
        $products = $this->productService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.price-catalogue.index', compact('request', 'items', 'buyerTypes', 'suppliers', 'products'));
    }

    public function export()
    {
        $rows = $this->priceCatalogueService->export($this->request);

        foreach ($rows as $row):
            $data[] = [
                __('pages/price-catalogue.table.col_1') => $row->tipe_pembeli->nama,
                __('pages/price-catalogue.table.col_2') => $row->pemasok->nama_perusahaan . '(' . $row->pemasok->nama_pic . ')',
                __('pages/price-catalogue.table.col_3') => $row->produk->kode . ' - ' . $row->produk->nama,
                __('pages/price-catalogue.table.col_4') => $row->harga_beli,
                __('pages/price-catalogue.table.col_5') => $row->harga_jual,
                __('pages/price-catalogue.table.col_6') => $row->het,
                __('pages/price-catalogue.table.col_7') => $row->laba,
            ];
        endforeach;

        return FastExcel::data($data)->download('price_catalogue_' . Carbon::now()->format('Ymd') . '.xlsx');
    }

    public function create()
    {
        $buyerTypes = $this->buyerTypeService->all();
        $products = $this->productService->all();

        return view('contents.price-catalogue.create', compact('buyerTypes', 'products'));
    }

    public function store(CreateRequest $createRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $createRequest->handle();
            if ($this->priceCatalogueService->isExist($data) == null):
                $this->priceCatalogueService->store($data);
                $this->cmsLogService->store(['log' => session()->get('user')->username . ' Menambahkan Katalog Harga Baru.']);
            else:
                return back()->with('error', __('global.exist_notification'));
            endif;
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('price-catalogue.index')->with('success', __('global.store_success_notification'));
    }

    public function edit($id)
    {
        $buyerTypes = $this->buyerTypeService->all();
        $products = $this->productService->all();
        $item = $this->priceCatalogueService->getById($id);

        return view('contents.price-catalogue.edit', compact('buyerTypes', 'products', 'item'));
    }

    public function update($id, UpdateRequest $updateRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $updateRequest->handle();
            $this->priceCatalogueService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengubah Katalog Harga Dengan ID ' . $id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('price-catalogue.index')->with('success', __('global.update_success_notification'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try
        {
            $this->priceCatalogueService->destroy($id);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Menghapus Katalog Harga Dengan ID ' . $id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('price-catalogue.index')->with('success', __('global.destroy_success_notification'));
    }
}
