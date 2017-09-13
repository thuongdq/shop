<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
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
        $args = func_get_args();
        unset($args[0], $args[1]);
        $args = array_values($args);
        if(auth()->check()){
            if (auth()->user()->hasRole($args)) {
                return $next($request);
            }
            return redirect()->route('frontend.home.index');
        }else{
            return redirect()->route('admin.login');
        }
    }
}
