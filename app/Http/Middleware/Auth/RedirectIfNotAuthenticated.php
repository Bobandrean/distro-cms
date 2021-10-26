<?php
/**
 * Created by PhpStorm.
 * User: oselwang
 * Date: 23/10/18
 * Time: 09.20
 */

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        return $next($request);
    }
}
