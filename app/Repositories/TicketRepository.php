<?php

namespace App\Repositories;

use App\Models\Ticket ;
use App\Traits\baseRepositoryTrait;
use Carbon\Carbon;

class TicketRepository
{
    use baseRepositoryTrait;

    /**
     * @var Ticket
     */
    private $model;

    /**
     * TicketRepository constructor.
     * @param Ticket $model
     */
    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model->with('pembeli');

        if (isset($request['from']) && !empty($request['from']))
        {
            $query = $query->where('created_at', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        }

        if (isset($request['to']) && !empty($request['to']))
        {
            $query = $query->where('created_at', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        }

        if (isset($request['user']) && !empty($request['user']))
        {
            $query = $query->whereHas('pembeli', function ($pembeli) use ($request) {
                $pembeli->where('nama_depan', 'LIKE' , '%'.$request['user'].'%')
                        ->orWhere('nama_belakang', 'LIKE', '%'.$request['user'].'%')
                        ->orWhere('nama_usaha', 'LIKE', '%'.$request['user'].'%');
            });
        }

        if (isset($request['email']) && !empty($request['email']))
        {
            $query = $query->whereHas('pembeli', function ($pembeli) use ($request) {
                $pembeli->where('email', 'LIKE' , '%'.$request['email'].'%');
            });
        }

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');

        return $query;
    }
}

