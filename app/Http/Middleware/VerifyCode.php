<?php

namespace App\Http\Middleware;

use App\Security;
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
        if (!Security::whereCode($code)->exists()) {
            return abort(401, 'Code is invalid');
        }

        return $next($request);
    }
}
