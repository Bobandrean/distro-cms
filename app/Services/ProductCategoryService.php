<?php

namespace App\Services;

use App\Repositories\ProductCategoryRepository;

class ProductCategoryService
{
    /**
     * @var ProductCategoryRepository
     */
    private $productCategoryRepository;

    /**
     * ProductCategoryService constructor.
     * @param ProductCategoryRepository $productCategoryRepository
     */

    public function __construct(ProductCategoryRepository $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
    }

    public function all()
    {
        return $this->productCategoryRepository->allActiveOnly();
    }

    public function datatable($request)
    {
        return $this->productCategoryRepository->datatable($request);
    }

    public function getById($id)
    {
        return $this->productCategoryRepository->getById($id);
    }

    public function store($data)
    {
        return $this->productCategoryRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->productCategoryRepository->update($id, $data);
    }

    public function export($request)
    {
        return $this->productCategoryRepository->export($request);
    }

    public function datatableOnlyTrashed($request)
    {
        return $this->productCategoryRepository->datatableOnlyTrashed($request);
    }
}
