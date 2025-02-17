<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = session('token');
            if (!$token) {
                throw new \Exception('Token not found in session');
            }

            // Validasi token
            $user = JWTAuth::setToken($token)->authenticate();

            // Lanjutkan ke controller jika token valid
            return $next($request);
        } catch (\Exception $e) {
            // Redirect ke halaman login jika token tidak valid
            return redirect()->route('auth.login.page'); // Ganti dengan route login Anda
        }
    }
}
