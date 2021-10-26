<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $UserRepository
     */

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function datatable($request)
    {
        return $this->userRepository->datatable($request);
    }

    public function getById($id)
    {
        return $this->userRepository->getById($id);
    }

    public function update($id, $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }

    public function store($data)
    {
        return $this->userRepository->store($data);
    }
}
