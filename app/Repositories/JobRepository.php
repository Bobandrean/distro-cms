<?php

namespace App\Repositories;

use App\Models\Job;
use App\Traits\baseRepositoryTrait;

class JobRepository
{
    use baseRepositoryTrait;

    /**
     * @var Job
     */
    private $model;

    /**
     * Job constructor.
     * @param Job $model
     */
    public function __construct(Job $model)
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
