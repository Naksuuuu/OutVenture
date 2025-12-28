<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPassword extends Component
{
    public $token, $email, $password, $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
        // Secara otomatis mengambil email dari URL (?email=...) yang dikirim Laravel
        $this->email = request()->query('email');
    }

    public function resetPassword()
    {
        $this->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
                $user->setRememberToken(Str::random(60));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('success', 'Password berhasil diubah! Silakan login dengan password baru.');
            return redirect()->route('auth.login');
        }

        $this->addError('email', 'Token atau email tidak valid (mungkin sudah kedaluwarsa).');
    }

    public function render()
    {
        return view('livewire.auth.reset-password')
            ->layout('components.layouts.auth', ['title' => 'Reset Password']);
    }
}
