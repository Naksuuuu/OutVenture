<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $userFromGoogle = Socialite::driver('google')->stateless()->user();

        // 1. Cek apakah user sudah ada berdasarkan email atau google_id
        $existingUser = User::where('email', $userFromGoogle->getEmail())->first();

        if ($existingUser) {
            // Jika user ada, pastikan google_id terupdate (jika sebelumnya null)
            if (!$existingUser->google_id) {
                $existingUser->update([
                    'google_id' => $userFromGoogle->getId(),
                    'email_verified_at' => now(), // Assume verified if login via Google
                ]);
            }

            // Login user
            Auth::login($existingUser);
            session()->regenerate();
            return redirect()->route('home');
        } else {
            // 2. Jika user BELUM ada, simpan data sementara di session dan redirect ke halaman set password
            session([
                'google_user_data' => [
                    'name' => $userFromGoogle->getName(),
                    'email' => $userFromGoogle->getEmail(),
                    'google_id' => $userFromGoogle->getId(),
                ]
            ]);

            return redirect()->route('auth.google-set-password');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
