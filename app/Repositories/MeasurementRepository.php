<?php

namespace App\Repositories;

use App\Models\Measurement;
use App\Traits\baseRepositoryTrait;

class MeasurementRepository
{
    use baseRepositoryTrait;

    /**
     * @var Measurement
     */
    private $model;

    /**
     * Measurement constructor.
     * @param Measurement $model
     */
    public function __construct(Measurement $model)
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
