<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $userFromGoogle = Socialite::driver('google')->stateless()->user();

        // 1. Jika user belum ada, buat baru & simpan
        $user = User::updateOrCreate(
            [
                'email' => $userFromGoogle->getEmail() 
            ],
            [
                'nama_lengkap' => $userFromGoogle->getName(),
                'google_id' => $userFromGoogle->getId(),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password'  => bcrypt('12345678'),
                'role' => 'user',
                'no_telepon' => null,
            ]
        );

        // 2. Login user
        Auth::login($user);
        session()->regenerate();

        // 3. Redirect
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
