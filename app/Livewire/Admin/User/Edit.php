<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.admin.user.edit')->layout('components.layouts.admin', ['title' => 'Edit Admin User']);
    }
}
