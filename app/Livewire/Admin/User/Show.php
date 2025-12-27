<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;

class Show extends Component
{
    public function render()
    {
        return view('livewire.admin.user.show')->layout('components.layouts.admin', ['title' => 'Admin User Details']);
    }
}
