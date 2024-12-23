<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login')->with('isLoginPage', true);
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username_or_email' => 'required|string',
            'password' => 'required',
        ], [
            'username_or_email.required' => 'Username atau Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Tentukan apakah input adalah email atau username
        $field = filter_var($request->username_or_email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Autentikasi
        if (Auth::attempt([$field => $request->username_or_email, 'password' => $request->password], $request->has('remember'))) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            // Redirect berdasarkan role
            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('success', 'Selamat datang Admin!');
                case 'petugas':
                    return redirect()->route('petugas')->with('success', 'Selamat datang Petugas!');
                case 'pelanggan':
                    return redirect()->route('pengaduan.index')->with('success', 'Selamat datang Masyarakat!');
                default:
                    Auth::logout();
                    return back()->withErrors(['role' => 'Role tidak dikenali. Hubungi admin.']);
            }
        }

        return back()->withErrors([
            'error' => 'Email atau Username dan Password yang Anda masukkan salah.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'Anda telah logout');
    }
}
