<?php

namespace App\Services;

use App\Repositories\RejectRepository;
use App\Traits\fileUploadTrait;

class RejectService
{
    use fileUploadTrait;
    /**
     * @var RejectRepository
     */
    private $rejectRepository;

    /**
     * RejectService constructor.
     * @param RejectRepository $rejectRepository
     */

    public function __construct(RejectRepository $rejectRepository)
    {
        $this->rejectRepository = $rejectRepository;
    }

    public function datatable($request)
    {
        return $this->rejectRepository->datatable($request);
    }

    public function getById($id)
    {
        return $this->rejectRepository->getById($id);
    }

    public function store($data)
    {
        return $this->rejectRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->rejectRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->rejectRepository->destroy($id);
    }
    public function export($request)
    {
        return $this->rejectRepository->export($request);
    }
}
