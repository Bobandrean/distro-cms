<?php

namespace App\Repositories;

use App\Models\PriceCatalogue;
use App\Traits\baseRepositoryTrait;
use Illuminate\Support\Facades\DB;

class PriceCatalogueRepository
{
    use baseRepositoryTrait;

    /**
     * @var PriceCatalogue
     */
    private $model;

    /**
     * PriceCatalogue constructor.
     * @param PriceCatalogue $model
     */
    public function __construct(PriceCatalogue $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model->with(['tipe_pembeli', 'produk', 'pemasok', 'kategori_produk']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('id_pemasok', session()->get('department')->id);
        endif;

        if (isset($request['buyer_type']) && !empty($request['buyer_type'])):
            $query = $query->where('id_tipe_pembeli', $request['buyer_type']);
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['product']) && !empty($request['product'])):
            $query = $query->where('id_produk', $request['product']);
        endif;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function export($request)
    {
        $query = $this->model->with(['tipe_pembeli', 'produk', 'pemasok', 'kategori_produk']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('id_pemasok', session()->get('department')->id);
        endif;

        if (isset($request['buyer_type']) && !empty($request['buyer_type'])):
            $query = $query->where('id_tipe_pembeli', $request['buyer_type']);
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['product']) && !empty($request['product'])):
            $query = $query->where('id_produk', $request['product']);
        endif;

        $query = $query->latest('created_at')->get();
        return $query;
    }

    public function isExist($data)
    {
        return $this->model->where('id_tipe_pembeli', $data['id_tipe_pembeli'])
                ->where('id_produk', $data['id_produk'])
                ->first();
    }

    public function updateByProductId($productId, $price)
    {
        return $this->model->where('id_produk', $productId)
                ->update([
                    'harga_beli' => $price,
                    'laba' => DB::raw('harga_jual - '.(double)$price)
                ]);
    }

}
