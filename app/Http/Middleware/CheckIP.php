<?php

namespace App\Http\Middleware;

use Closure;

class CheckIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allowed = explode(',', env('ALLOWED_IPS', ''));

        if(empty(array_intersect($allowed, $request->ips()))) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
