<?php

namespace App\Repositories;

use App\Models\District;
use App\Traits\baseRepositoryTrait;

class DistrictRepository
{
    use baseRepositoryTrait;

    /**
     * @var District
     */
    private $model;

    /**
     * District constructor.
     * @param District $model
     */
    public function __construct(District $model)
    {
        $this->model = $model;
    }

    public function getByDistrictId($id)
    {
        return $this->model->where('id_kota', $id)->get();
    }

}
