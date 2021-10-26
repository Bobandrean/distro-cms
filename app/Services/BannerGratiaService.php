<?php

namespace App\Services;

use App\Repositories\BannerGratiaRepository;
use App\Traits\fileUploadTrait;

class BannerGratiaService
{
    use fileUploadTrait;

    /**
     * @var BannerGratiaRepository
     * @var CmsLogService;
     */
    private $bannerGratiaRepository;
    private $cmsLogService;

    /**
     * BannerService constructor.
     * @param BannerGratiaRepository $bannerGratiaRepository
     * @param CmsLogService $cmsLogService
     */

    public function __construct(BannerGratiaRepository $bannerGratiaRepository,CmsLogService $cmsLogService)
    {
        $this->bannerGratiaRepository = $bannerGratiaRepository;
        $this->cmsLogService = $cmsLogService;
    }

    public function datatable($request)
    {
        return $this->bannerGratiaRepository->datatable($request);
    }

    public function getById($id)
    {
        return $this->bannerGratiaRepository->getById($id);
    }

    public function store($data)
    {
        return $this->bannerGratiaRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->bannerGratiaRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->bannerGratiaRepository->destroy($id);
    }
}
