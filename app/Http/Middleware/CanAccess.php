<?php

namespace App\Http\Middleware;

use Closure;

class CanAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $index = null, $key = null)
    {
        if (auth()->check()) {
            $permissiom = json_decode(auth()->user()->group->permissions);

            if (isset($key) && isset($index) && $permissiom->{$index}->{$key}) {
                return $next($request);
            }
            elseif (isset($index) && $permissiom->{$index}) {
                return $next($request);
            }
            else {
                return redirect('/');
            }
        } 

    }
}