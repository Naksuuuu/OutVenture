<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($validate)) {
            // Login Berhasil
            // Perbarui session ID (keamanan)
            $request->session()->regenerate();

            if (Auth::User()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            // Arahkan ke dashboard
            return redirect()->route('home');
        }

        // Login Gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',

        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.show.login');
    }
}
