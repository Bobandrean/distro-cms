<?php

namespace App\Repositories;

use App\Models\FCM;
use App\Traits\baseRepositoryTrait;

class FCMRepository
{
    use baseRepositoryTrait;

    /**
     * @var FCM
     */
    private $model;

    /**
     * FCM constructor.
     * @param FCM $model
     */
    public function __construct(FCM $model)
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
