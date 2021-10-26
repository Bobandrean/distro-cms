<?php

namespace App\Services;

use App\Repositories\PaymentTypeRepository;

class PaymentTypeService
{
    /**
     * @var PaymentTypeRepository
     */
    private $paymentTypeRepository;

    /**
     * PaymentTypeService constructor.
     * @param PaymentTypeRepository $paymentTypeRepository
     */

    public function __construct(PaymentTypeRepository $paymentTypeRepository)
    {
        $this->paymentTypeRepository = $paymentTypeRepository;
    }

    public function all()
    {
        return $this->paymentTypeRepository->all();
    }
}
