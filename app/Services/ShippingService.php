<?php

namespace App\Services;

use App\Repositories\ShippingRepository;


class ShippingService
{
    /**
     * @var ShippingRepository
     */
    private $shippingRepository;

    /**
     * ShippingService constructor.
     * @param ShippingRepository $shippingRepository

     */

    public function __construct(ShippingRepository $shippingRepository)
    {
        $this->shippingRepository = $shippingRepository;
    }

    public function datatable($request)
    {
        return $this->shippingRepository->datatable($request);
    }

    public function getById($id)
    {
        return $this->shippingRepository->getById($id);
    }

    public function getByUserId($userId)
    {
        return $this->shippingRepository->getByUserId($userId);
    }

    public function store($data)
    {
        return $this->shippingRepository->store($data);
    }
    
    public function update($id, $data)
    {
        return $this->shippingRepository->update($id, $data);
    }

    public function getByWarehouseId($warehouseId)
    {
        return $this->shippingRepository->getByWarehouseId($warehouseId);
    }

}
