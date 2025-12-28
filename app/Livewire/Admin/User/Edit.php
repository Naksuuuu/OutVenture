<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public User $admin;
    public string $role = 'user';

    protected $rules = [
        'role' => 'required|in:admin,user',
    ];

    public function mount(string $id)
    {
        $this->admin = User::findOrFail($id);
        $this->role = $this->admin->role ?? 'user';
    }

    public function update()
    {
        if ($this->admin->role === 'superadmin') {
            session()->flash('notifyError', 'Role superadmin tidak dapat diubah.');
            $this->redirect(route('admin.users.index'));
            return;
        }

        $this->validate();

        $this->admin->role = $this->role;
        $this->admin->save();

        session()->flash('notifySuccess', 'Hak akses diperbarui menjadi '.strtoupper($this->role).'.');

        $this->redirect(route('admin.users.index'));
    }

    public function render()
    {
        return view('livewire.admin.user.edit')->layout('components.layouts.admin', ['title' => 'Edit Admin User']);
    }
}
