<?php

namespace App\Repositories;

use App\Models\Province;
use App\Traits\baseRepositoryTrait;

class ProvinceRepository
{
    use baseRepositoryTrait;

    /**
     * @var Province
     */
    private $model;

    /**
     * Province constructor.
     * @param Province $model
     */
    public function __construct(Province $model)
    {
        $this->model = $model;
    }

}
