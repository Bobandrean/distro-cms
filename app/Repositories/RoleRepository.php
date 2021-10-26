<?php

namespace App\Repositories;

use App\Models\Role;
use App\Traits\baseRepositoryTrait;

class RoleRepository
{
    use baseRepositoryTrait;

    /**
     * @var Role
     */
    private $model;

    /**
     * RoleRepository constructor.
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}

