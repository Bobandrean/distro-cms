<?php

namespace App\Services;

use App\Repositories\PriceCatalogueRepository;

class PriceCatalogueService
{
    /**
     * @var PriceCatalogueRepository
     */
    private $priceCatalogueRepository;

    /**
     * PriceCatalogueService constructor.
     * @param PriceCatalogueRepository $priceCatalogueRepository
     */

    public function __construct(PriceCatalogueRepository $priceCatalogueRepository)
    {
        $this->priceCatalogueRepository = $priceCatalogueRepository;
    }

    public function datatable($request)
    {
        return $this->priceCatalogueRepository->datatable($request);
    }

    public function store($data)
    {
        return $this->priceCatalogueRepository->store($data);
    }

    public function getById($id)
    {
        return $this->priceCatalogueRepository->getByIdWith($id, ['tipe_pembeli', 'produk', 'pemasok', 'kategori_produk']);
    }

    public function update($id, $data)
    {
        return $this->priceCatalogueRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->priceCatalogueRepository->destroy($id);
    }

    public function export($request)
    {
        return $this->priceCatalogueRepository->export($request);
    }

    public function isExist($data)
    {
        return $this->priceCatalogueRepository->isExist($data);
    }

    public function updateByProductId($productId, $price)
    {
        return $this->priceCatalogueRepository->updateByProductId($productId, $price);
    }
}
