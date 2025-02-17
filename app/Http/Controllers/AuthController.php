<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $userpassword = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($userpassword)) {
                return response()->json(
                    [
                        'status' => false,
                        'error' => 'Unauthorized',
                        'message' => 'Login failed! Please try again'
                    ],
                    401
                );
            }

            $user = JWTAuth::user();

            // Store the token in the session
            session(['token' => $token]);

            return redirect()->route('buku.index')->with([
                'status' => true,
                'message' => 'Login successful',
                'user' => $user,
            ]);
        } catch (JWTException $e) {
            return response()->json(['status' => false, 'message' => 'Could not create token'], 500);
        }
    }
}
