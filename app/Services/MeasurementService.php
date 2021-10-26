<?php

namespace App\Services;

use App\Repositories\MeasurementRepository;

class MeasurementService
{
    /**
     * @var MeasurementRepository
     */
    private $measurementRepository;

    /**
     * MeasurementService constructor.
     * @param MeasurementRepository $measurementRepository
     */

    public function __construct(MeasurementRepository $measurementRepository)
    {
        $this->measurementRepository = $measurementRepository;
    }

    public function all()
    {
        return $this->measurementRepository->all();
    }
}
