<?php

namespace App\Services;

use App\Repositories\PurchaseOrderItemRepository;

class PurchaseOrderItemService
{
    /**
     * @var PurchaseOrderItemRepository
     */
    private $purchaseOrderItemRepository;

    /**
     * PurchaseOrderItemService constructor.
     * @param PurchaseOrderItemRepository $purchaseOrderItemRepository
     */

    public function __construct(PurchaseOrderItemRepository $purchaseOrderItemRepository)
    {
        $this->purchaseOrderItemRepository = $purchaseOrderItemRepository;
    }

    public function topProductCategories($request)
    {
       return $this->purchaseOrderItemRepository->topProductCategories($request);
    }

    public function topProducts($request)
    {
        return $this->purchaseOrderItemRepository->topProducts($request);
    }
}
