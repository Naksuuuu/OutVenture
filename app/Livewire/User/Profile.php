<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{

  public $user = '';

  public function render()
  {

    $this->user = Auth::user();

    return view('livewire.user.profile')
      ->layout('components.layouts.app', ['title' => 'Profile']);
  }
}
