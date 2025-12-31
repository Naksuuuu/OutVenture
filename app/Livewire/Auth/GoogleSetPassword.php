<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class GoogleSetPassword extends Component
{
  public $password;
  public $password_confirmation;
  public $googleData;

  public function mount()
  {
    $this->googleData = session('google_user_data');

    if (!$this->googleData) {
      return redirect()->route('login');
    }
  }

  protected $rules = [
    'password' => 'required|min:8|confirmed',
  ];

  public function save()
  {
    $this->validate();

    $user = User::create([
      'nama_lengkap' => $this->googleData['name'],
      'email' => $this->googleData['email'],
      'google_id' => $this->googleData['google_id'],
      'password' => Hash::make($this->password),
      'email_verified_at' => now(),
      'role' => 'user',
      // no_telepon null by default
    ]);

    Auth::login($user);

    session()->forget('google_user_data');
    session()->regenerate();

    return redirect()->route('home');
  }

  public function render()
  {
    return view('livewire.auth.google-set-password')->layout('components.layouts.auth', ['title' => 'Set Password']);
  }
}
