<?php

namespace App\Repositories;

use App\Models\Village;
use App\Traits\baseRepositoryTrait;

class VillageRepository
{
    use baseRepositoryTrait;

    /**
     * @var Village
     */
    private $model;

    /**
     * Village constructor.
     * @param Village $model
     */
    public function __construct(Village $model)
    {
        $this->model = $model;
    }

    public function getByDistrictId($id)
    {
        return $this->model->where('id_kecamatan', $id)->get();
    }
}
