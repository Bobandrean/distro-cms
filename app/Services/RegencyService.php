<?php

namespace App\Services;

use App\Repositories\RegencyRepository;

class RegencyService
{
    /**
     * @var RegencyRepository
     */
    private $regencyRepository;

    /**
     * RegencyService constructor.
     * @param RegencyRepository $regencyRepository
     */

    public function __construct(RegencyRepository $regencyRepository)
    {
        $this->regencyRepository = $regencyRepository;
    }

    public function all()
    {
        return $this->regencyRepository->all();
    }

    public function getByProvinceId($id)
    {
        return $this->regencyRepository->getByProvinceId($id);
    }
}
