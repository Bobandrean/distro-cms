<?php

namespace App\Repositories;

use App\Models\Bank;
use App\Traits\baseRepositoryTrait;

class BankRepository
{
    use baseRepositoryTrait;

    /**
     * @var Bank
     */
    private $model;

    /**
     * Bank constructor.
     * @param Bank $model
     */
    public function __construct(Bank $model)
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
