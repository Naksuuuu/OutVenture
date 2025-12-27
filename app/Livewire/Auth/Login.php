<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
  public $email = '';
  public $password = '';
  public $remember = false;

  protected $rules = [
    'email' => 'required|email',
    'password' => 'required|string',
  ];

  public function login()
  {
    $this->validate();

    if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
      $user = Auth::user();

      if (!$user->hasVerifiedEmail()) {
        Auth::logout();

        // Berikan pesan error spesifik di halaman login
        $this->addError('email', 'Akun Anda belum aktif. Silakan verifikasi email Anda terlebih dahulu sebelum login.');
        return;
      }

      session()->regenerate();
      if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
      }

      return redirect()->route('home');
    }

    $this->addError('email', 'Email atau password salah.');
  }

  public function render()
  {
    return view('livewire.auth.login')
      ->layout('components.layouts.auth', ['title' => 'Login']);
  }
}
