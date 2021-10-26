<?php

namespace App\Services;

use App\Repositories\PaymentTypeMethodRepository;

class PaymentTypeMethodService
{
    /**
     * @var PaymentTypeMethodRepository
     */
    private $paymentTypeMethodRepository;

    /**
     * PaymentTypeMethodService constructor.
     * @param PaymentTypeMethodRepository $paymentTypeMethodRepository
     */

    public function __construct(PaymentTypeMethodRepository $paymentTypeMethodRepository)
    {
        $this->paymentTypeMethodRepository = $paymentTypeMethodRepository;
    }

    public function totalPlafon($request)
    {
        return $this->paymentTypeMethodRepository->totalPlafon($request);
    }

    public function all()
    {
        return $this->paymentTypeMethodRepository->all();
    }

    public function store($data)
    {
        return $this->paymentTypeMethodRepository->store($data);
    }

    public function getByCustomerIdAndPaymentType($customerId, $paymentId)
    {
        return $this->paymentTypeMethodRepository->getByCustomerIdAndPaymentType($customerId, $paymentId);
    }

    public function destroyByCustomerIdAndPaymentType($customerId, $paymentId)
    {
        return $this->paymentTypeMethodRepository->destroyByCustomerIdAndPaymentType($customerId, $paymentId);
    }
}
