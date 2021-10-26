<?php

namespace App\Services;

use App\Repositories\RoleRepository ;
use Illuminate\Support\Facades\DB;

class RoleService
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * RoleService constructor.
     * @param RoleRepository $roleRepository
     */

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function all()
    {
        return $this->roleRepository->all();
    }

    public function getById($id)
    {
        return $this->roleRepository->getById($id);
    }

    public function update($id, $data)
    {
        return $this->roleRepository->update($id, $data);
    }
}
