<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public User $admin;

    public function mount(string $id): void
    {
        $this->admin = User::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.user.show')
            ->layout('components.layouts.admin', ['title' => 'Admin User Details']);
    }
}
