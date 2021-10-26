<?php

namespace App\Repositories;

use App\Models\PrivacyPolicy;
use App\Traits\baseRepositoryTrait;

class PrivacyPolicyRepository
{
    use baseRepositoryTrait;

    /**
     * @var PrivacyPolicy
     */
    private $model;

    /**
     * PrivacyPolicyRepository constructor.
     * @param PrivacyPolicy $model
     */
    public function __construct(PrivacyPolicy $model)
    {
        $this->model = $model;
    }
}

