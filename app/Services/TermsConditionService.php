<?php

namespace App\Services;

use App\Repositories\TermsConditionRepository;

class TermsConditionService
{
    /**
     * @var TermsConditionRepository
     */
    private $termsConditionRepository;

    /**
     * TermsConditionService constructor.
     * @param TermsConditionRepository $termsConditionRepository
     */

    public function __construct(TermsConditionRepository $termsConditionRepository)
    {
        $this->termsConditionRepository = $termsConditionRepository;
    }

    public function getFirst()
    {
        return $this->termsConditionRepository->getById(1);
    }

    public function update($data)
    {
        return $this->termsConditionRepository->update(1, $data);
    }
}
