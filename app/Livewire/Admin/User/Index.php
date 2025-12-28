<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {

        $admins = User::get();


        return view('livewire.admin.user.index', ['admins' => $admins])->layout('components.layouts.admin', ['title' => 'Admin Users']);
    }
}
