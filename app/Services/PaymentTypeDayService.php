<?php

namespace App\Services;

use App\Repositories\PaymentTypeDayRepository;

class PaymentTypeDayService
{
    /**
     * @var PaymentTypeDayRepository
     */
    private $paymentTypeDayRepository;

    /**
     * PaymentTypeDayService constructor.
     * @param PaymentTypeDayRepository $paymentTypeDayRepository
     */

    public function __construct(PaymentTypeDayRepository $paymentTypeDayRepository)
    {
        $this->paymentTypeDayRepository = $paymentTypeDayRepository;
    }

    public function totalPlafon($request)
    {
        return $this->paymentTypeDayRepository->totalPlafon($request);
    }

    public function all()
    {
        return $this->paymentTypeDayRepository->all();
    }

    public function store($data)
    {
        return $this->paymentTypeDayRepository->store($data);
    }

    public function getByCustomerIdAndPaymentType($customerId, $paymentId)
    {
        return $this->paymentTypeDayRepository->getByCustomerIdAndPaymentType($customerId, $paymentId);
    }

    public function destroyByCustomerIdAndPaymentType($customerId, $paymentId)
    {
        return $this->paymentTypeDayRepository->destroyByCustomerIdAndPaymentType($customerId, $paymentId);
    }
}
