<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15|unique:users',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru
        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke halaman login setelah registrasi sukses
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
