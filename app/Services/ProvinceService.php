<?php

namespace App\Services;

use App\Repositories\ProvinceRepository;

class ProvinceService
{
    /**
     * @var ProvinceRepository
     */
    private $provinceRepository;

    /**
     * ProvinceService constructor.
     * @param ProvinceRepository $provinceRepository
     */

    public function __construct(ProvinceRepository $provinceRepository)
    {
        $this->provinceRepository = $provinceRepository;
    }

    public function all()
    {
        return $this->provinceRepository->all();
    }
}
