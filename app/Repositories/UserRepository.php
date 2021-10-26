<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\baseRepositoryTrait;

class UserRepository
{
    use baseRepositoryTrait;

    /**
     * @var User
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
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

