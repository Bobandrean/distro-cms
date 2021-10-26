<?php

namespace App\Services;

use App\Repositories\DistrictRepository;

class DistrictService
{
    /**
     * @var DistrictRepository
     */
    private $districtRepository;

    /**
     * DistrictService constructor.
     * @param DistrictRepository $districtRepository
     */

    public function __construct(DistrictRepository $districtRepository)
    {
        $this->districtRepository = $districtRepository;
    }

    public function getByDistrictId($id)
    {
        return $this->districtRepository->getByDistrictId($id);
    }
}
