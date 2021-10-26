<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pages\Stock\CreateRequest;
use App\Http\Requests\Pages\Stock\UpdateRequest;
use App\Services\CmsLogService;
use App\Services\ProductService;
use App\Services\WarehouseService;
use App\Services\StockService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class StockController extends Controller
{
    private $request;
    private $stockService;
    private $warehouseService;
    private $productService;
    private $cmsLogService;

    public function __construct(Request $request, StockService $stockService, WarehouseService $warehouseService, ProductService $productService, CmsLogService $cmsLogService)
    {
        $this->request = $request;
        $this->stockService = $stockService;
        $this->warehouseService = $warehouseService;
        $this->productService = $productService;
        $this->cmsLogService = $cmsLogService;
    }

    public function index()
    {
        $request = $this->request;
        $items = $this->stockService->datatable($this->request);
        $warehouses = $this->warehouseService->all();
        $products = $this->productService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.stock.index', compact('request', 'items', 'warehouses', 'products'));
    }

    public function export()
    {
        $rows = $this->stockService->export($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/stock.table.col_1') => $row->gudang->nama_gudang,
                __('pages/stock.table.col_2') => $row->produk->kode . ' - ' . $row->produk->nama,
                __('pages/stock.table.col_3') => $row->stok_minimum,
                __('pages/stock.table.col_4') => $row->jumlah_stok
            ];
        endforeach;

        return FastExcel::data($data)->download('stock_' . Carbon::now()->format('Ymd') . '.xlsx');
    }

    public function create()
    {
        $products = $this->productService->all();

        return view('contents.stock.create', compact('products'));
    }

    public function store(CreateRequest $createRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $createRequest->handle();
            if ($this->stockService->isExist($data) == null):
                $this->stockService->store($data);
                $this->cmsLogService->store(['log' => session()->get('user')->username . ' Menambahkan Stok Barang Baru.']);
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

        return redirect()->route('stock.index')->with('success', __('global.store_success_notification'));
    }

    public function edit($id)
    {
        $item = $this->stockService->getById($id);
        $products = $this->productService->all();

        return view('contents.stock.edit', compact('item', 'products'));
    }

    public function update($id, UpdateRequest $updateRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $updateRequest->handle();
            $this->stockService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengubah Stok Barang Dengan ID ' . $id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('stock.index')->with('success', __('global.update_success_notification'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try
        {
            $this->stockService->destroy($id);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Menghapus Stok Barang Dengan ID ' . $id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('stock.index')->with('success', __('global.destroy_success_notification'));
    }
}
