<?php

namespace App\Repositories;

use App\Models\Kaspro;
use App\Traits\baseRepositoryTrait;

class KasproRepository
{
    use baseRepositoryTrait;

    /**
     * @var Kaspro
     */
    private $model;

    /**
     * Kaspro constructor.
     * @param Kaspro $model
     */
    public function __construct(Kaspro $model)
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
