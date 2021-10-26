<?php

namespace App\Services;

use App\Repositories\VillageRepository;

class VillageService
{
    /**
     * @var VillageRepository
     */
    private $villageRepository;

    /**
     * VillageService constructor.
     * @param VillageRepository $villageRepository
     */

    public function __construct(VillageRepository $villageRepository)
    {
        $this->villageRepository = $villageRepository;
    }

    public function getByDistrictId($id)
    {
        return $this->villageRepository->getByDistrictId($id);
    }
}
