<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SkipCsrfForSpecificRoutes
{
    protected $except = [
        '/auth/login',
    ];

    public function handle(Request $request, Closure $next)
    {
        foreach ($this->except as $route) {
            if ($request->is($route)) {
                return $next($request);
            }
        }

        return app('Illuminate\Foundation\Http\Middleware\ValidateCsrfToken')->handle($request, $next);
    }
}
