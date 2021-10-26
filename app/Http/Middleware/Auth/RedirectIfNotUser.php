<?php
/**
 * Created by PhpStorm.
 * User: oselwang
 * Date: 18/10/18
 * Time: 09.30
 */

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotUser
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
        if (session()->get('user') == null) {
            return redirect()->route('login.index');
        }
        return $next($request);
    }
}
