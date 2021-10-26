<?php

namespace App\Http\Middleware;

use App\Services\RoleService;
use Closure;
use Illuminate\Http\Request;

class RoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function handle($request, Closure $next)
    {
        $role_id = $request->session()->get('user')->tipe_akun->id;

        $role = $this->roleService->getById($role_id);

        $request->session()->put('permissions', json_decode($role->permissions, true));

        return $next($request);
    }
}
