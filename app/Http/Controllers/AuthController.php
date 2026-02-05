<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // tampilkan halaman login
    public function login()
    {
        return view('auth.login');
    }

    // proses login
    public function prosesLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // ambil username & password
        $credentials = $request->only('username', 'password');

        // autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // cek admin
            if (Auth::user()->isadmin == 1) {
                return redirect('/home')
                    ->with('success', 'Login berhasil');
            }

            // kalau bukan admin
            Auth::logout();
            return back()->with('error', 'Anda bukan admin');
        }

        return back()->with('error', 'Username atau password salah');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
