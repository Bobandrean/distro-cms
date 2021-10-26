<?php

namespace App\Repositories;

use App\Models\CartDetail;
use App\Traits\baseRepositoryTrait;

class CartDetailRepository
{
    use baseRepositoryTrait;

    /**
     * @var CartDetail
     */
    private $model;

    /**
     * CartDetail constructor.
     * @param CartDetail $model
     */
    public function __construct(CartDetail $model)
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
