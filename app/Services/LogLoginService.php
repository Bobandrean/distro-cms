<?php

namespace App\Services;

use App\Repositories\LogLoginRepository;

class LogLoginService
{
    /**
     * @var LogLoginRepository
     */
    private $logLoginRepository;

    /**
     * LogLoginService constructor.
     * @param LogLoginRepository $logLoginRepository
     */

    public function __construct(LogLoginRepository $logLoginRepository)
    {
        $this->logLoginRepository = $logLoginRepository;
    }

    public function datatable($request)
    {
        return $this->logLoginRepository->datatable($request);
    }

    public function store($data)
    {
        return $this->logLoginRepository->store($data);
    }

    public function export($request)
    {
        return $this->logLoginRepository->export($request);
    }
}
