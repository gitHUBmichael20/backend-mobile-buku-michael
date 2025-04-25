<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Login successful',
                'user' => Auth::user()
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid email or password'
        ], 401);
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
