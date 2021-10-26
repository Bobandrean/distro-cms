<?php

namespace App\Services;

use App\Repositories\PrivacyPolicyRepository;

class PrivacyPolicyService
{
    /**
     * @var PrivacyPolicyRepository
     */
    private $privacyPolicyRepository;

    /**
     * PrivacyPolicyService constructor.
     * @param PrivacyPolicyRepository $privacyPolicyRepository
     */

    public function __construct(PrivacyPolicyRepository $privacyPolicyRepository)
    {
        $this->privacyPolicyRepository = $privacyPolicyRepository;
    }

    public function getFirst()
    {
        return $this->privacyPolicyRepository->getById(1);
    }

    public function update($data)
    {
        return $this->privacyPolicyRepository->update(1, $data);
    }
}
