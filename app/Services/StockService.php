<?php

namespace App\Services;

use App\Repositories\StockRepository;

class StockService
{
    /**
     * @var StockRepository
     */
    private $stockRepository;
    /**
     * StockService constructor.
     * @param StockRepository $stockRepository
     */

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function all()
    {
        return $this->stockRepository->all();
    }

    public function datatable($request)
    {
        return $this->stockRepository->datatable($request);
    }

    public function store($data)
    {
        return $this->stockRepository->store($data);
    }

    public function getById($id)
    {
        return $this->stockRepository->getById($id);
    }

    public function update($id, $data)
    {
        return $this->stockRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->stockRepository->destroy($id);
    }

    public function export($request)
    {
        return $this->stockRepository->export($request);
    }

    public function isExist($data)
    {
        return $this->stockRepository->isExist($data);
    }

    public function getByProductId($productId)
    {
        return $this->stockRepository->getByProductId($productId);
    }
}
