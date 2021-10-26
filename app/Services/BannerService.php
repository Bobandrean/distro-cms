<?php

namespace App\Services;

use App\Repositories\BannerRepository;
use App\Traits\fileUploadTrait;

class BannerService
{
    use fileUploadTrait;
    /**
     * @var BannerRepository
     */
    private $bannerRepository;

    /**
     * BannerService constructor.
     * @param BannerRepository $bannerRepository
     */

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function datatable($request)
    {
        return $this->bannerRepository->datatable($request);
    }

    public function getById($id)
    {
        return $this->bannerRepository->getById($id);
    }

    public function store($data)
    {
        return $this->bannerRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->bannerRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->bannerRepository->destroy($id);
    }
    public function export($request)
    {
        return $this->bannerRepository->export($request);
    }
}
