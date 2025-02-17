<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

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
            // Retrieve token from session
            $token = session('token');
            if (!$token) {
                throw new \Exception('Token not found in session');
            }

            // Authenticate using the token
            $user = JWTAuth::setToken($token)->authenticate();
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token invalid: ' . $e->getMessage()
            ], 401);
        }

        return redirect()->route('manage')
            ->header('Authorization', 'Bearer ' . $token);
    }
}
