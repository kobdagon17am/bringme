<?php

namespace App\Http\Middleware;

use Closure;
use User;

class Admin
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
        if (User::check() && User::user()->isAdmin()) {
            return $next($request);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
