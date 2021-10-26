<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Traits\baseRepositoryTrait;

class StockRepository
{
    use baseRepositoryTrait;

    /**
     * @var Stock
     */
    private $model;

    /**
     * Stock constructor.
     * @param Stock $model
     */
    public function __construct(Stock $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model->with(['gudang', 'produk']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->whereHas('produk', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id);
            });
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->whereHas('produk', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id_pemasok);
            });
        endif;

        if (isset($request['warehouse']) && !empty($request['warehouse'])):
            $query = $query->where('id_gudang', $request['warehouse']);
        endif;

        if (isset($request['product']) && !empty($request['product'])):
            $query = $query->where('id_produk', $request['product']);
        endif;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function export($request)
    {
        $query = $this->model->with(['gudang', 'produk']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->whereHas('produk', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id);
            });
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->whereHas('produk', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id_pemasok);
            });
        endif;

        if (isset($request['warehouse']) && !empty($request['warehouse'])):
            $query = $query->where('id_gudang', $request['warehouse']);
        endif;

        if (isset($request['product']) && !empty($request['product'])):
            $query = $query->where('id_produk', $request['product']);
        endif;

        $query = $query->latest('created_at')->get();
        return $query;
    }

    public function isExist($data)
    {
        return $this->model->where('id_gudang', $data['id_gudang'])
            ->where('id_produk', $data['id_produk'])
            ->first();
    }

    public function getByProductId($productId)
    {
        return $this->model->with(['gudang','produk'])->where('id_produk', $productId)->first();
    }
}
