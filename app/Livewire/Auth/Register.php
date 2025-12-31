<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
  public $nama_lengkap = '';
  public $email = '';
  public $password = '';
  public $password_confirmation = '';

  protected $rules = [
    'nama_lengkap' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users,email',
    'password' => 'required|string|min:8|confirmed',
  ];

  /**
   * Mendaftarkan pengguna baru.
   */
  public function register()
  {
    $this->validate();

    $user = User::create([
      'nama_lengkap' => $this->nama_lengkap,
      'email' => $this->email,
      'password' => Hash::make($this->password),
    ]);

    event(new Registered($user));

    session()->flash('success', 'Registrasi berhasil! Silahkan Verifikasi email Anda sebelum login.');

    return redirect()->route('auth.login');
  }

  /**
   * Merender tampilan halaman registrasi.
   */
  public function render()
  {
    return view('livewire.auth.register')
      ->layout('components.layouts.auth', ['title' => 'Register']);
  }
}
