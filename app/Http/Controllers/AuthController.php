<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //

    public function showLogin()
    {
        // Jika pengguna sudah login, arahkan ke index
        if (session('token')) {
            return redirect()->route('buku.index');
        }

        return view('login'); // Tampilkan halaman login
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'wrong password'], 401);
            }

            // Save the token in the session
            session(['token' => $token]);
            session()->save();

            // Get the authenticated user
            $user = JWTAuth::user();

            // Return the token to the client as well
            return response()->json([
                'message' => 'success',
                'token' => $token,
                'user' => $user
            ]);
        } catch (JWTException $e) {
            return response()->json(['message' => 'failed to create token'], 500);
        }
    }

    public function logout()
    {
        // Clear the session
        session()->forget('token');
        session()->flush();

        // Redirect to login page
        return redirect()->route('auth.login.page')->with('success', 'Logged out!');
    }
}
