<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
  public $nama_lengkap = '';
  public $no_telepon = '';
  public $alamat = '';
  public $email = '';
  public $password = '';
  public $password_confirmation = '';

  protected $rules = [
    'nama_lengkap' => 'required|string|max:255',
    'no_telepon' => 'required|string|max:15|unique:users,no_telepon',
    'alamat' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users,email',
    'password' => 'required|string|min:8|confirmed',
  ];

  public function register()
  {
    $this->validate();

    $user = User::create([
      'nama_lengkap' => $this->nama_lengkap,
      'no_telepon' => $this->no_telepon,
      'alamat' => $this->alamat,
      'email' => $this->email,
      'password' => Hash::make($this->password),
    ]);

    event(new Registered($user));

    session()->flash('success', 'Registrasi berhasil! Silahkan Verifikasi email Anda sebelum login.');

    return redirect()->route('auth.login');
  }

  public function render()
  {
    return view('livewire.auth.register')
      ->layout('components.layouts.auth', ['title' => 'Register']);
  }
}
