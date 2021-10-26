<?php

namespace App\Repositories;

use App\Models\KasproMember;
use App\Traits\baseRepositoryTrait;

class KasproMemberRepository
{
    use baseRepositoryTrait;

    /**
     * @var KasproMember
     */
    private $model;

    /**
     * KasproMember constructor.
     * @param KasproMember $model
     */
    public function __construct(KasproMember $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function getByUserId($userId)
    {
        return $this->model->where('id_user', $userId)->first();
    }
}
