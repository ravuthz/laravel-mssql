<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class VerifyCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $code = $request->header('Security-Code');

        if (!User::where('token', $code)->exists()) {
            return abort(401, 'Security-Code is invalid');
        }

        return $next($request);
    }
}
