<?php

namespace App\Repositories;

use App\Models\LogNotification;
use App\Traits\baseRepositoryTrait;

class LogNotificationRepository
{
    use baseRepositoryTrait;

    /**
     * @var LogNotification
     */
    private $model;

    /**
     * LogNotification constructor.
     * @param LogNotification $model
     */
    public function __construct(LogNotification $model)
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
