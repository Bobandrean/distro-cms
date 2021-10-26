<?php

namespace App\Repositories;

use App\Models\Warehouse;
use App\Traits\baseRepositoryTrait;

class WarehouseRepository
{
    use baseRepositoryTrait;

    /**
     * @var Warehouse
     */
    private $model;

    /**
     * Warehouse constructor.
     * @param Warehouse $model
     */
    public function __construct(Warehouse $model)
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

        $query = $query->latest('created_at')->get();

        return $query;
    }

    public function datatable($request)
    {
        $query = $this->model;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function getBySupplierId($supplierId)
    {
        return $this->model->where('id_pemasok', $supplierId)->first();
    }

    public function getByUserId($userId)
    {
        return $this->model->where('id_user', $userId)->first();
    }
}
