<?php

namespace App\Repositories;

use App\Models\Reject;
use App\Traits\baseRepositoryTrait;

class RejectRepository
{
    use baseRepositoryTrait;

    /**
     * @var Reject
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param Reject $model
     */
    public function __construct(Reject $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model->with(['pembeli','tipe_pembayaran']);

        if (isset($request['buyer']) && !empty($request['buyer']))
        {
            $query = $query->where('id_pembeli', 'LIKE', '%'.$request['buyer'].'%');
        }

        if (isset($request['buyer_type']) && !empty($request['buyer_type']))
        {
            $query = $query->where('id_pembayaran', 'LIKE', '%'.$request['buyer_type'].'%');
        }

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function export($request)
    {
        $query = $this->model;

        if (isset($request['buyer']) && !empty($request['buyer']))
        {
            $query = $query->where('id_pembeli', 'LIKE', '%'.$request['buyer'].'%');
        }

        if (isset($request['buyer_type']) && !empty($request['buyer_type']))
        {
            $query = $query->where('id_pembayaran', 'LIKE', '%'.$request['buyer_type'].'%');
        }
        $query = $query->latest('created_at')->get();
        return $query;
    }

}

