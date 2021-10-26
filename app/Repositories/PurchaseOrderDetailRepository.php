<?php

namespace App\Repositories;

use App\Models\PurchaseOrderDetail;
use App\Traits\baseRepositoryTrait;

class PurchaseOrderDetailRepository
{
    use baseRepositoryTrait;

    /**
     * @var PurchaseOrderDetail
     */
    private $model;

    /**
     * PurchaseOrderDetail constructor.
     * @param PurchaseOrderDetail $model
     */
    public function __construct(PurchaseOrderDetail $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }
    public function updateDetail($id, array $input)
    {
        $query = $this->model->where('id_po',$id)->update($input);

        return $query;

    }
    
}
