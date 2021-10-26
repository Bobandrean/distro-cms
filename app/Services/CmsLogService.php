<?php

namespace App\Services;

use App\Repositories\CmsLogRepository;

class CmsLogService
{
    /**
     * @var CmsLogRepository
     */
    private $cmsLogRepository;

    /**
     * BannerService constructor.
     * @param CmsLogRepository $cmsLogRepository
     */

    public function __construct(CmsLogRepository $cmsLogRepository)
    {
        $this->cmsLogRepository = $cmsLogRepository;
    }

    public function datatable($request)
    {
        return $this->cmsLogRepository->datatable($request);
    }

    public function store($request)
    {
        $data['id_user'] = session()->get('user')->id;
        $data['log'] = $request['log'];

        $this->cmsLogRepository->store($data);
    }

    public function export($request)
    {
        return $this->cmsLogRepository->export($request);
    }
}
