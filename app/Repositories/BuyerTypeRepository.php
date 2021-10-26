<?php

namespace App\Repositories;

use App\Models\BuyerType;
use App\Traits\baseRepositoryTrait;

class BuyerTypeRepository
{
    use baseRepositoryTrait;

    /**
     * @var BuyerType
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param BuyerType $model
     */
    public function __construct(BuyerType $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        $query = $this->model;

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('id_pemasok', session()->get('department')->id);
        endif;

        $query = $query->latest('created_at')->get();

        return $query;
    }

    public function datatable($request)
    {
        $query = $this->model;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['name']) && !empty($request['name'])):
            $query = $query->where('nama', 'LIKE', '%'.$request['name'].'%');
        endif;

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('id_pemasok', session()->get('department')->id);
        endif;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function export($request)
    {
        $query = $this->model;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['name']) && !empty($request['name'])):
            $query = $query->where('nama', 'LIKE', '%'.$request['name'].'%');
        endif;

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('id_pemasok', session()->get('department')->id);
        endif;

        $query = $query->latest('created_at')->get();
        return $query;
    }

}

