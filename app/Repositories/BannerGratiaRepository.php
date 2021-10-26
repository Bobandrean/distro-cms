<?php

namespace App\Repositories;

use App\Models\BannerGratia;
use App\Traits\baseRepositoryTrait;

class BannerGratiaRepository
{
    use baseRepositoryTrait;

    /**
     * @var BannerGratia
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param BannerGratia $model
     */
    public function __construct(BannerGratia $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model;

        if (isset($request['name']) && !empty($request['name']))
        {
            $query = $query->where('name', 'LIKE', '%'.$request['name'].'%');
        }

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

}

