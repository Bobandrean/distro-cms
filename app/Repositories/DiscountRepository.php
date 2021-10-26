<?php

namespace App\Repositories;

use App\Models\Discount;
use App\Traits\baseRepositoryTrait;

class DiscountRepository
{
    use baseRepositoryTrait;

    /**
     * @var Discount
     */
    private $model;

    /**
     * Discount constructor.
     * @param Discount $model
     */
    public function __construct(Discount $model)
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
