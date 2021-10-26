<?php

namespace App\Repositories;

use App\Models\CmsLog;
use App\Traits\baseRepositoryTrait;
use Carbon\Carbon;

class CmsLogRepository
{
    use baseRepositoryTrait;

    /**
     * @var CmsLog
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param CmsLog $model
     */
    public function __construct(CmsLog $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model->with('users');

        if (isset($request['from']) && !empty($request['from']))
        {
            $query = $query->where('created_at', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        }

        if (isset($request['to']) && !empty($request['to']))
        {
            $query = $query->where('created_at', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        }

        if (isset($request['username']) && !empty($request['username']))
        {
            $query = $query->whereHas('users', function ($user) use ($request) {
                $user->where('username', $request['username']);
            });
        }

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');

        return $query;
    }

    public function export($request)
    {
        $query = $this->model->with('users');

        if (isset($request['from']) && !empty($request['from']))
        {
            $query = $query->where('created_at', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        }

        if (isset($request['to']) && !empty($request['to']))
        {
            $query = $query->where('created_at', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        }

        if (isset($request['username']) && !empty($request['username']))
        {
            $query = $query->whereHas('users', function ($user) use ($request) {
                $user->where('username', $request['username']);
            });
        }

        $query = $query->latest('created_at')->get();

        return $query;
    }

}

