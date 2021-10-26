<?php

namespace App\Repositories;

use App\Models\PaymentType;
use App\Traits\baseRepositoryTrait;

class PaymentTypeRepository
{
    use baseRepositoryTrait;

    /**
     * @var PaymentType
     */
    private $model;

    /**
     * PaymentType constructor.
     * @param PaymentType $model
     */
    public function __construct(PaymentType $model)
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
