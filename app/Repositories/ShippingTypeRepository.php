<?php

namespace App\Repositories;

use App\Models\ShippingType;
use App\Traits\baseRepositoryTrait;

class ShippingTypeRepository
{
    use baseRepositoryTrait;

    /**
     * @var ShippingType
     */
    private $model;

    /**
     * ShippingType constructor.
     * @param ShippingType $model
     */
    public function __construct(ShippingType $model)
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
