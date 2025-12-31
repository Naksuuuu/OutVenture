<?php

namespace App\Livewire\Admin\Color;

use Livewire\Component;
use App\Models\Color;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $successMessage = '';
    public $errorMessage = '';

    protected $queryString = ['search'];

    /**
     * Mereset halaman pagination saat kata kunci pencarian berubah.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }




    /**
     * Menghapus warna dari database.
     */
    public function delete($id)
    {
        $this->errorMessage = '';
        $color = Color::find($id);


        if (!$color) {
            $this->errorMessage = 'Data tidak ditemukan.';
            return;
        }

        if ($color->productVariants()->exists()) {
            $this->errorMessage = 'Warna masih memiliki varian produk, hapus atau pindahkan varian produk terlebih dahulu.';
            return;
        }

        $color->delete();

        $this->dispatch('delete-success');
        $this->dispatch('notify', type: 'success', message: 'Warna berhasil dihapus!');
    }

    /**
     * Merender daftar warna dengan pencarian dan pagination.
     */
    public function render()
    {
        $query = Color::withCount('productVariants')->orderBy('id', 'asc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_warna', 'like', '%' . $this->search . '%')
                    ->orWhere('hex_code', 'like', '%' . $this->search . '%');
            });
        }

        $colors = $query->paginate(8);

        return view('livewire.admin.color.index', [
            'colors' => $colors,
            'totalColors' => Color::count(),
        ])->layout('components.layouts.admin', ['title' => 'Colors Management']);
    }
}
