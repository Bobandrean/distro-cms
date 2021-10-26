<?php

namespace App\Repositories;

use App\Models\GlobalNotification;
use App\Traits\baseRepositoryTrait;

class GlobalNotificationRepository
{
    use baseRepositoryTrait;

    /**
     * @var GlobalNotification
     */
    private $model;

    /**
     * GlobalNotification constructor.
     * @param GlobalNotification $model
     */
    public function __construct(GlobalNotification $model)
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
