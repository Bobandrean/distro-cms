<?php

namespace App\Services;

use App\Repositories\SupplierRepository;

class SupplierService
{

    /**
     * @var SupplierRepository
     */
    private $supplierRepository;

    /**
     * SupplierService constructor.
     * @param SupplierRepository $supplierRepository
 */

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function all()
    {
        return $this->supplierRepository->all();
    }

    public function datatable($request)
    {
        return $this->supplierRepository->datatable($request);
    }

    public function trashedOnlyDatatable($request)
    {
        return $this->supplierRepository->trashedOnlyDatatable($request);
    }

    public function getById($id)
    {
        return $this->supplierRepository->getByIdWith($id, ['users', 'job']);
    }

    public function getByUserId($userId)
    {
        return $this->supplierRepository->getByUserId($userId);
    }

    public function store($data)
    {
        return $this->supplierRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->supplierRepository->update($id, $data);
    }

    public function destroy($id, $data)
    {
        return $this->supplierRepository->update($id, $data);
    }

    public function export($request)
    {
        return $this->supplierRepository->export($request);
    }

    public function getNumber($request)
    {
        return $this->supplierRepository->getNumber($request);
    }

    public function getInactiveSupplier($active)
    {
        return $this->supplierRepository->getInactiveSupplier($active);
    }

    public function inactiveSupplierDatatable()
    {
        return $this->supplierRepository->inactiveSupplierDatatable();
    }
    
}
