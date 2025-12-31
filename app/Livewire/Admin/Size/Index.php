<?php

namespace App\Livewire\Admin\Size;

use App\Models\SizeGroup;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Index extends Component
{
    use WithPagination;

    public $errorMessage = '';


    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(history: true, keep: true)]
    public $sortBy = 'latest';

    /**
     * Mereset halaman pagination saat kata kunci pencarian berubah.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Mereset halaman pagination saat sorting berubah.
     */
    public function updatingSortBy()
    {
        $this->resetPage();
    }


    /**
     * Menghapus grup ukuran dari database.
     */
    public function delete($id)
    {
        $sizeGroup = SizeGroup::find($id);

        if (!$sizeGroup) {
            $this->errorMessage = 'Data tidak ditemukan.';
            return;
        }

        if ($sizeGroup->values()->exists()) {
            $this->errorMessage = 'Grup ukuran masih memiliki nilai ukuran, hapus atau pindahkan nilai ukuran terlebih dahulu.';
            return;
        }

        if ($sizeGroup->categories()->exists()) {
            $this->errorMessage = 'Grup ukuran masih digunakan pada kategori, hapus atau pindahkan kategori terlebih dahulu.';
            return;
        }

        $sizeGroup->delete();

        $this->dispatch('delete-success');
        $this->dispatch('notify', type: 'success', message: 'Grup ukuran berhasil dihapus!');
    }

    /**
     * Merender daftar grup ukuran dengan pencarian dan pagination.
     */
    public function render()
    {
        $sizeGroups = SizeGroup::query()
            ->when($this->search, function ($query) {
                $query->where('nama_group', 'like', '%' . $this->search . '%');
            })
            ->withCount(['values', 'categories'])
            ->when($this->sortBy === 'latest', function ($query) {
                $query->latest();
            })
            ->when($this->sortBy === 'oldest', function ($query) {
                $query->oldest();
            })
            ->paginate(10);

        return view('livewire.admin.size.index', ['sizeGroups' => $sizeGroups])
            ->layout('components.layouts.admin', ['title' => 'Size Management']);
    }
}
