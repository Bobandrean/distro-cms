<?php

namespace App\Services;

use App\Repositories\BuyerTypeRepository;
use App\Traits\fileUploadTrait;

class BuyerTypeService
{
    use fileUploadTrait;
    /**
     * @var BuyerTypeRepository
     */
    private $buyerTypeRepository;

    /**
     * BuyerTypeService constructor.
     * @param BuyerTypeRepository $buyerTypeRepository
     */

    public function __construct(BuyerTypeRepository $buyerTypeRepository)
    {
        $this->buyerTypeRepository = $buyerTypeRepository;
    }

    public function all()
    {
        return $this->buyerTypeRepository->all();
    }

    public function datatable($request)
    {
        return $this->buyerTypeRepository->datatable($request);
    }

    public function getById($id)
    {
        return $this->buyerTypeRepository->getById($id);
    }

    public function store($data)
    {
        return $this->buyerTypeRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->buyerTypeRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->buyerTypeRepository->destroy($id);
    }

    public function export($request)
    {
        return $this->buyerTypeRepository->export($request);
    }

}
