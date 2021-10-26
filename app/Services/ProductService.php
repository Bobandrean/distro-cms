<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Traits\fileUploadTrait;

class ProductService
{
    use fileUploadTrait;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * ProductService constructor.
     * @param ProductRepository $productRepository
     */

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function datatable($request)
    {
        return $this->productRepository->datatable($request);
    }

    public function datatableOnlyTrashed($request)
    {
        return $this->productRepository->datatableOnlyTrashed($request);
    }

    public function store($data)
    {
        return $this->productRepository->store($data);
    }

    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function update($id, $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function export($request)
    {
        return $this->productRepository->export($request);
    }
}
