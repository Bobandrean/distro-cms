<?php

namespace App\Repositories;

use App\Models\PurchaseOrderBilling;
use App\Traits\baseRepositoryTrait;

class PurchaseOrderBillingRepository
{
    use baseRepositoryTrait;

    /**
     * @var PurchaseOrderBilling
     */
    private $model;

    /**
     * PurchaseOrderBilling constructor.
     * @param PurchaseOrderBilling $model
     */
    public function __construct(PurchaseOrderBilling $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }
    
}
