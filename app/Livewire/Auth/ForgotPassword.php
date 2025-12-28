<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{

    public $email = '';

    public function sendResetLink()
    {
        $this->validate([
            'email' => 'required|email',
        ], [
            'email.exist' => 'Email tidak terdaftar',
        ]);

        $status = Password::sendResetLink([
            'email' => $this->email
        ]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('message', 'Link reset password telah dikirim ke email Anda.');
            $this->email = '';
        } else {
            session()->flash('error', 'Gagal mengirim link reset password. Silakan coba lagi.');
        }
    }


    public function render()
    {
        return view('livewire.auth.forgot-password')->layout('components.layouts.auth', [
            'title' => 'Lupa Password'
        ]);
    }
}
