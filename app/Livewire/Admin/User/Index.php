<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = '';
    public $sort = '';

    protected $queryString = ['search', 'roleFilter', 'sort'];

    /**
     * Mereset halaman pagination saat kata kunci pencarian berubah.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Mereset halaman pagination saat filter peran berubah.
     */
    public function updatingRoleFilter()
    {
        $this->resetPage();
    }

    /**
     * Mereset halaman pagination saat sorting berubah.
     */
    public function updatingSort()
    {
        $this->resetPage();
    }

    /**
     * Merender daftar pengguna dengan filter dan pagination.
     */
    public function render()
    {
        $query = User::query();

        if ($this->roleFilter !== '') {
            $query->where('role', $this->roleFilter);
        }

        if ($this->sort) {
            if ($this->sort === 'latest') {
                $query->latest();
            } else {
                $query->oldest();
            }
        }

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $admins = $query->paginate(10);

        return view('livewire.admin.user.index', ['admins' => $admins])
            ->layout('components.layouts.admin', ['title' => 'Admin Users']);
    }
}
