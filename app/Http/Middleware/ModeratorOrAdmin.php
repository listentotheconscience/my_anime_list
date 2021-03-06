<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ModeratorOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role !== 'user') {
            return $next($request);
        }

        return response('You don\'t have permissions', 403);
    }
}
