<?php

namespace App\Repositories;

use App\Models\Regency;
use App\Traits\baseRepositoryTrait;

class RegencyRepository
{
    use baseRepositoryTrait;

    /**
     * @var Regency
     */
    private $model;

    /**
     * Regency constructor.
     * @param Regency $model
     */
    public function __construct(Regency $model)
    {
        $this->model = $model;
    }

    public function getByProvinceId($id)
    {
        return $this->model->where('id_provinsi', $id)->get();
    }
}
