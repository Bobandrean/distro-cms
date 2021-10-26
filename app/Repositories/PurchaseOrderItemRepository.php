<?php

namespace App\Repositories;

use App\Models\PurchaseOrderItem;
use App\Traits\baseRepositoryTrait;
use Illuminate\Support\Facades\DB;

class PurchaseOrderItemRepository
{
    use baseRepositoryTrait;

    /**
     * @var PurchaseOrderItem
     */
    private $model;

    /**
     * PurchaseOrderItem constructor.
     * @param PurchaseOrderItem $model
     */
    public function __construct(PurchaseOrderItem $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function topProductCategories($request)
    {
        $query = $this->model
            ->join('produk', 'po_barang.id_produk', '=', 'produk.id')
            ->join('kategori_produk', 'produk.id_kategori_produk', '=', 'kategori_produk.id')
            ->join('po', 'po.id', '=', 'po_barang.id_po')
            ->where('kategori_produk.hapus', '0')
            ->where('po.status_po', '!=', 'Dibatalkan')
            ->select('kategori_produk.nama as nama', DB::raw('SUM(po_barang.total) as total'));

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('po.id_pemasok', session()->get('department')->id);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->where('po.id_pemasok', session()->get('department')->id_pemasok);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'pengiriman'):
            $query = $query->where('po.id_pemasok', session()->get('department')->gudang->id_pemasok);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'pembeli'):
            $query = $query->where('po.id_pembeli', session()->get('department')->id);
        endif;

        if (isset($request['year']) && !empty($request['year'])):
            $query = $query->whereYear('po.updated_at', $request['year']);
        endif;

        $query = $query->groupBy('nama')
            ->orderBy('total', 'DESC')
            ->take(10)
            ->get();

        return $query;
    }

    public function topProducts($request)
    {
        $query = $this->model
            ->join('produk', 'po_barang.id_produk', '=', 'produk.id')
            ->join('po', 'po.id', '=', 'po_barang.id_po')
            ->where('produk.hapus', '0')
            ->where('po.status_po', '!=', 'Dibatalkan')
            ->select('produk.nama as nama', DB::raw('SUM(po_barang.total) as total'));

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('po.id_pemasok', session()->get('department')->id);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->where('po.id_pemasok', session()->get('department')->id_pemasok);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'pengiriman'):
            $query = $query->where('po.id_pemasok', session()->get('department')->gudang->id_pemasok);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'pembeli'):
            $query = $query->where('po.id_pembeli', session()->get('department')->id);
        endif;

        if (isset($request['year']) && !empty($request['year'])):
            $query = $query->whereYear('po.updated_at', $request['year']);
        endif;

        $query = $query->groupBy('nama')
            ->orderBy('total', 'DESC')
            ->take(10)
            ->get();

        return $query;
    }
}
