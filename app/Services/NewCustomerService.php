<?php

namespace App\Services;

use App\Repositories\NewCustomerRepository;
use Illuminate\Support\Facades\DB;

class NewCustomerService
{
    /**
     * @var NewCustomerRepository
     * @var CmsLogService;
     */
    private $userService;
    private $newCustomerRepository;
    private $cmsLogService;

    /**
     * customerService constructor.
     * @param NewCustomerRepository $newCustomerRepository
     * @param CmsLogService $cmsLogService
     */

    public function __construct(NewCustomerRepository $newCustomerRepository)
    {
        $this->newCustomerRepository = $newCustomerRepository;
    }

    public function datatable($request)
    {
        return $this->newCustomerRepository->datatable($request);
    }

}
