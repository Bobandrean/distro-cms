<?php

namespace App\Services;

use App\Repositories\PurchaseOrderDetailRepository;

class PurchaseOrderDetailService
{
    /**
     * @var PurchaseOrderDetailRepository
     */
    private $purchaseOrderDetailRepository;

    /**
     * PurchaseOrderDetailService constructor.
     * @param PurchaseOrderDetailRepository $purchaseOrderDetailRepository
     */

    public function __construct(PurchaseOrderDetailRepository $purchaseOrderDetailRepository)
    {
        $this->purchaseOrderDetailRepository = $purchaseOrderDetailRepository;
    }

    public function all()
    {
        return $this->purchaseOrderDetailRepository->all();
    }

    public function datatable($request)
    {
        return $this->purchaseOrderDetailRepository->datatable($request);
    }

    public function getById($id)
    {
        return $this->purchaseOrderDetailRepository->getById($id);
    }

    public function getByIdWith($id, $relations)
    {
        return $this->purchaseOrderDetailRepository->getByIdWith($id, $relations);
    }

    public function store($data)
    {
        return $this->purchaseOrderDetailRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->purchaseOrderDetailRepository->update($id, $data);
    }
    public function updateDetail($id, array $data)
    {
        return $this->purchaseOrderDetailRepository->updateDetail($id,$data);
    }

    public function destroy($id)
    {
        return $this->purchaseOrderDetailRepository->destroy($id);
    }
    public function datatableKreditPro($request)
    {
        return $this->purchaseOrderDetailRepository->datatable($request);
    }
    
}
