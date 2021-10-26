<?php

namespace App\Repositories;

use App\Models\Product;
use App\Traits\baseRepositoryTrait;

class ProductRepository
{
    use baseRepositoryTrait;

    /**
     * @var Product
     */
    private $model;

    /**
     * Product constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        $query = $this->model;

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('id_pemasok', session()->get('department')->id);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->where('id_pemasok', session()->get('department')->id_pemasok);
        endif;

        $query = $query->where('hapus', '0')
            ->latest('created_at')
            ->get();

        return $query;
    }

    public function datatable($request)
    {
        $query = $this->model->with(['pemasok.users.tipe_akun', 'pemasok.job', 'kategori_produk', 'satuan_produk', 'jenis_kemasan']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('id_pemasok', session()->get('department')->id);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->where('id_pemasok', session()->get('department')->id_pemasok);
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['product_category']) && !empty($request['product_category'])):
            $query = $query->where('id_kategori_produk', $request['product_category']);
        endif;

        if (isset($request['sku']) && !empty($request['sku'])):
            $query = $query->where('kode', 'like', '%'.$request['sku'].'%');
        endif;

        if (isset($request['product_name']) && !empty($request['product_name'])):
            $query = $query->where('nama', 'like', '%'.$request['product_name'].'%');
        endif;

        if (isset($request['ppn']) && !empty($request['ppn'])):
            $query = $query->where('ppn', $request['ppn']);
        endif;

        $query = $query->where('hapus', '0')
            ->latest('created_at')
            ->paginate(10, ['*'], 'all');

        return $query;
    }

    public function datatableOnlyTrashed($request)
    {
        $query = $this->model->with(['pemasok.users.tipe_akun', 'pemasok.job', 'kategori_produk', 'satuan_produk', 'jenis_kemasan']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('id_pemasok', session()->get('department')->id);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->where('id_pemasok', session()->get('department')->id_pemasok);
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['product_category']) && !empty($request['product_category'])):
            $query = $query->where('id_kategori_produk', $request['product_category']);
        endif;

        if (isset($request['sku']) && !empty($request['sku'])):
            $query = $query->where('kode', 'like', '%'.$request['sku'].'%');
        endif;

        if (isset($request['product_name']) && !empty($request['product_name'])):
            $query = $query->where('nama', 'like', '%'.$request['product_name'].'%');
        endif;

        if (isset($request['tax']) && !empty($request['tax'])):
            $query = $query->where('ppn', $request['tax']);
        endif;

        $query = $query->where('hapus', '1')
            ->latest('created_at')
            ->paginate(10, ['*'], 'trashed');

        return $query;
    }

    public function export($request)
    {
        $query = $this->model->with(['pemasok.users.tipe_akun', 'pemasok.job', 'kategori_produk', 'satuan_produk', 'jenis_kemasan']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('id_pemasok', session()->get('department')->id);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->where('id_pemasok', session()->get('department')->id_pemasok);
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['product_category']) && !empty($request['product_category'])):
            $query = $query->where('id_kategori_produk', $request['product_category']);
        endif;

        if (isset($request['sku']) && !empty($request['sku'])):
            $query = $query->where('kode', 'like', '%'.$request['sku'].'%');
        endif;

        if (isset($request['product_name']) && !empty($request['product_name'])):
            $query = $query->where('nama', 'like', '%'.$request['product_name'].'%');
        endif;

        if (isset($request['ppn']) && !empty($request['ppn'])):
            $query = $query->where('ppn', $request['ppn']);
        endif;

        $query = $query->where('hapus', '0')
            ->latest('created_at')
            ->get();

        return $query;
    }
}
