<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NutritionistMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'nutritionist') {
            return $next($request);
        }

        abort(403, 'Akses hanya untuk ahli gizi');
    }
}