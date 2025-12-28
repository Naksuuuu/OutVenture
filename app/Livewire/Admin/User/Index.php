<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public string $search = '';
    public string $roleFilter = '';

    public function render()
    {
        $admins = User::query()
            ->when($this->roleFilter !== '', function ($query) {
                $query->where('role', $this->roleFilter);
            })
            ->when($this->search !== '', function ($query) {
                $s = trim($this->search);
                $query->where(function ($q) use ($s) {
                    $q->where('nama_lengkap', 'like', "%{$s}%")
                        ->orWhere('name', 'like', "%{$s}%")
                        ->orWhere('email', 'like', "%{$s}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.admin.user.index', ['admins' => $admins])
            ->layout('components.layouts.admin', ['title' => 'Admin Users']);
    }
}
