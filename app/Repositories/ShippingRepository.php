<?php

namespace App\Repositories;

use App\Models\Shipping;
use App\Traits\baseRepositoryTrait;

class ShippingRepository
{
    use baseRepositoryTrait;

    /**
     * @var Shipping
     */
    private $model;

    /**
     * Shipping constructor.
     * @param Shipping $model
     */
    public function __construct(Shipping $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model;


        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function getByWarehouseId($warehouseId)
    {
        return $this->model->where('id_gudang', $warehouseId)->first();
    }

    public function getByUserId($userId)
    {
        return $this->model->with('gudang')->where('id_user', $userId)->first();
    }
}
