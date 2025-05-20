<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


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

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => Auth::user()
        ]);
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
