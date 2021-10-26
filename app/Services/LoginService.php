<?php

namespace App\Services;

use App\Repositories\LoginRepository;

class LoginService
{
    /**
     * @var LoginRepository
     */
    private $loginRepository;

    /**
     * LoginService constructor.
     * @param LoginRepository $loginRepository
     */

    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function login($data)
    {
        return $this->loginRepository->checkUser($data);
    }

    public function logout()
    {
        session()->flush();

        return true;
    }
}
