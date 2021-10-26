<?php

namespace App\Services;

use App\Repositories\CustomerSupplierRelationRepository;

class CustomerSupplierRelationService
{
    /**
     * @var CustomerSupplierRelationRepository
     */
    private $customerSupplierRelationRepository;

    /**
     * CustomerSupplierRelationService constructor.
     * @param CustomerSupplierRelationRepository $customerSupplierRelationRepository
     */

    public function __construct(CustomerSupplierRelationRepository $customerSupplierRelationRepository)
    {
        $this->customerSupplierRelationRepository = $customerSupplierRelationRepository;
    }

    public function getDistributorsbySupplierId($id, $request)
    {
        return $this->customerSupplierRelationRepository->getDistributorsbySupplierId($id, $request);
    }

    public function exportDistributorsBySupplierId($id, $request)
    {
        return $this->customerSupplierRelationRepository->exportDistributorsBySupplierId($id, $request);
    }

    public function getByCustomerId($customer_id)
    {
        return $this->customerSupplierRelationRepository->getByCustomerId($customer_id);
    }

    public function store($data)
    {
        return $this->customerSupplierRelationRepository->store($data);
    }

    public function destroy($id)
    {
        return $this->customerSupplierRelationRepository->destroy($id);
    }
}
