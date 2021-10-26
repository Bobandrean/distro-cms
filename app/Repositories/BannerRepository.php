<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Traits\baseRepositoryTrait;

class BannerRepository
{
    use baseRepositoryTrait;

    /**
     * @var Banner
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param Banner $model
     */
    public function __construct(Banner $model)
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

    public function export($request)
    {
        $query = $this->model;

        if (isset($request['name']) && !empty($request['name']))
        {
            $query = $query->where('name', 'LIKE', '%'.$request['name'].'%');
        }

        $query = $query->latest('created_at')->get();
        return $query;
    }

}

