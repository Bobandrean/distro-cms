<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Traits\baseRepositoryTrait;

class CartRepository
{
    use baseRepositoryTrait;

    /**
     * @var Cart
     */
    private $model;

    /**
     * Cart constructor.
     * @param Cart $model
     */
    public function __construct(Cart $model)
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
