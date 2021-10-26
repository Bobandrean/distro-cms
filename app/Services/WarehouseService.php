<?php

namespace App\Services;

use App\Repositories\WarehouseRepository;

class WarehouseService
{
    /**
     * @var WarehouseRepository
     */
    private $warehouseRepository;

    /**
     * WareHouseService constructor.
     * @param WarehouseRepository $warehouseRepository
     */

    public function __construct(WarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function all()
    {
        return $this->warehouseRepository->all();
    }

    public function datatable($request)
    {
        return $this->warehouseRepository->datatable($request);
    }

    public function getById($id)
    {
        return $this->warehouseRepository->getById($id);
    }

    public function getByUserId($userId)
    {
        return $this->warehouseRepository->getByUserId($userId);
    }

    public function store($data)
    {
       return $this->warehouseRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->warehouseRepository->update($id, $data);
    }

    public function getBySupplierId($supplierId)
    {
        return $this->warehouseRepository->getBySupplierId($supplierId);
    }
}
