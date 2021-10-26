<?php

namespace App\Services;

use App\Repositories\PackagingRepository;

class PackagingService
{
    /**
     * @var PackagingRepository
     */
    private $packagingRepository;

    /**
     * PackagingService constructor.
     * @param PackagingRepository $packagingRepository
     */

    public function __construct(PackagingRepository $packagingRepository)
    {
        $this->packagingRepository = $packagingRepository;
    }

    public function all()
    {
        return $this->packagingRepository->all();
    }
}
