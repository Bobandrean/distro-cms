<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\RequestForm;
use App\Services\LoginService;
use Illuminate\Http\Request;

class LoginRequest extends RequestForm
{
    protected $rules;

    protected $messages;

    private $loginService;

    public function __construct(Request $request = null, LoginService $loginService)
    {
        parent::__construct($request);

        $this->loginService = $loginService;

        $this->rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $data['username'] = $this->request->username;
        $data['password'] = $this->request->password;

        return $this->loginService->login($data);
    }
}
