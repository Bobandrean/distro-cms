<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Traits\baseRepositoryTrait;

class NewCustomerRepository
{
    use baseRepositoryTrait;

    /**
     * @var Customer
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param Customer $model
     */
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model->with('users')->whereHas('users', function ($user) use ($request) {
                $user->where('status', '0')->where('id_tipe_akun','3');
            })->latest('created_at')->paginate(10, ['*'], 'all');;

        return $query;
    }
    
}

