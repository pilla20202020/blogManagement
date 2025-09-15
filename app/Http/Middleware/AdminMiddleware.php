<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    use ApiResponse;
    public function handle(Request $request, Closure $next)
    {
        if (!auth('api')->user() || !auth('api')->user()->is_admin) {
            return $this->errorResponse('Forbidden: Admins only', 403);
        }
        return $next($request);
    }
}
