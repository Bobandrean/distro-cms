<?php

namespace App\Repositories;

use App\Models\ProductCategory;
use App\Traits\baseRepositoryTrait;


class ProductCategoryRepository
{
    use baseRepositoryTrait;

    private $model;

    public  function __construct(ProductCategory $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model;

        if (isset($request['name']) && !empty($request['name']))
        {
            $query = $query->where('nama', 'LIKE', '%'.$request['name'].'%');
        }

        $query = $query->where('hapus', '0')->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function datatableOnlyTrashed($request)
    {
        $query = $this->model;

        if (isset($request['nama']) && !empty($request['nama']))
        {
            $query = $query->where('nama', 'LIKE', '%'.$request['name'].'%');
        }

        $query = $query->where('hapus', '1')->latest('created_at')->paginate(10, ['*'], 'trashed');
        return $query;
    }

    public function export($request)
    {
        $query = $this->model;

        if (isset($request['nama']) && !empty($request['nama']))
        {
            $query = $query->where('nama', 'LIKE', '%'.$request['name'].'%');
        }

        $query = $query->where('hapus', '0')->latest('created_at')->get();
        return $query;
    }
}
