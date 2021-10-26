<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\baseRepositoryTrait;

class LoginRepository
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

    public function checkUser($request)
    {
        return $this->model->with('tipe_akun')
            ->where('username', $request['username'])
            ->where('password', md5($request['password']))
            ->where('status', '1')
            ->first();
    }

}

