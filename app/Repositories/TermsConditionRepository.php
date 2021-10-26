<?php

namespace App\Repositories;

use App\Models\TermsCondition;
use App\Traits\baseRepositoryTrait;

class TermsConditionRepository
{
    use baseRepositoryTrait;

    /**
     * @var TermsCondition
     */
    private $model;

    /**
     * TermsConditionRepository constructor.
     * @param TermsCondition $model
     */
    public function __construct(TermsCondition $model)
    {
        $this->model = $model;
    }
}

