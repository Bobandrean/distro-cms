<?php

namespace App\Services;

use App\Repositories\PaymentTypeCustomerRepository;

class PaymentTypeCustomerService
{
    /**
     * @var PaymentTypeCustomerRepository
     */
    private $paymentTypeCustomerRepository;

    /**
     * PaymentTypeCustomerService constructor.
     * @param PaymentTypeCustomerRepository $paymentTypeCustomerRepository
     */

    public function __construct(PaymentTypeCustomerRepository $paymentTypeCustomerRepository)
    {
        $this->paymentTypeCustomerRepository = $paymentTypeCustomerRepository;
    }

    public function totalPlafon($request)
    {
        return $this->paymentTypeCustomerRepository->totalPlafon($request);
    }

    public function all()
    {
        return $this->paymentTypeCustomerRepository->all();
    }

    public function getById($id)
    {
        return $this->paymentTypeCustomerRepository->getById($id);
    }

    public function store($data)
    {
        return $this->paymentTypeCustomerRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->paymentTypeCustomerRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->paymentTypeCustomerRepository->destroy($id);
    }

    public function datatableGroupByPaymentType()
    {
        return $this->paymentTypeCustomerRepository->datatableGroupByPaymentType();
    }

    public function getByPaymentTypeId($id, $request)
    {
        return $this->paymentTypeCustomerRepository->getByPaymentTypeId($id, $request);
    }

    public function exportByPaymentTypeId($id, $request)
    {
        return $this->paymentTypeCustomerRepository->exportByPaymentTypeId($id, $request);
    }

    public function getCreditInfo($customerId, $paymentId)
    {
        return $this->paymentTypeCustomerRepository->getCreditInfo($customerId, $paymentId);
    }

    public function destroyByCustomerIdAndPaymentType($customerId, $paymentId)
    {
        return $this->paymentTypeCustomerRepository->destroyByCustomerIdAndPaymentType($customerId, $paymentId);
    }
}
