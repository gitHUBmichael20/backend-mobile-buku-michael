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
            return redirect()->route('index');
        }

        return view('login'); // Tampilkan halaman login
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Simpan token di session
            session(['token' => $token]); // Pastikan ini berhasil
            session()->save(); // Force save session (opsional)

            return redirect()->route('buku.index');
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }
}
