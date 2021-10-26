<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * CustomerService constructor.
     * @param CustomerRepository $customerRepository
     */

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function all()
    {
        return $this->customerRepository->all();
    }

    public function datatable($request)
    {
        return $this->customerRepository->datatable($request);
    }

    public function getById($id)
    {
        return $this->customerRepository->getById($id);
    }

    public function getByIdWith($id, $relations)
    {
        return $this->customerRepository->getByIdWith($id, $relations);
    }

    public function store($data)
    {
        return $this->customerRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->customerRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->customerRepository->destroy($id);
    }

    public function getNumber($request)
    {
        return $this->customerRepository->getNumber($request);
    }

    public function export($request)
    {
        return $this->customerRepository->export($request);
    }

    public function getByUserId($userId)
    {
        return $this->customerRepository->getByUserId($userId);
    }

    public function getByPaymentId($payment_id, $request)
    {
        return $this->customerRepository->getByPaymentId($payment_id, $request);
    }

    public function getInactiveCustomer($active)
    {
        return $this->customerRepository->getInactiveCustomer($active);
    }

    
}
