<?php

namespace App\Repositories;

use App\Models\GlobalNotification;
use App\Traits\baseRepositoryTrait;

class NotificationRepository
{
    use baseRepositoryTrait;

    /**
     * @var GlobalNotification
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param GlobalNotification $model
     */
    public function __construct(GlobalNotification $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        return $this->model->latest('created_at')->paginate(10, ['*'], 'all');
    }

    public function export($request)
    {
        return $this->model->latest('created_at')->get();
    }

}

