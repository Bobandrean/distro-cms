<?php

namespace App\Repositories;

use App\Models\Packaging;
use App\Traits\baseRepositoryTrait;

class PackagingRepository
{
    use baseRepositoryTrait;

    /**
     * @var Packaging
     */
    private $model;

    /**
     * Packaging constructor.
     * @param Packaging $model
     */
    public function __construct(Packaging $model)
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
