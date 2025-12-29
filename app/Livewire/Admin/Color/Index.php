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

    public function updatingSearch()
    {
        $this->resetPage();
    }




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

    public function render()
    {
        $query = Color::withCount('productVariants')->orderBy('id', 'asc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_warna', 'like', '%' . $this->search . '%')
                    ->orWhere('hex_code', 'like', '%' . $this->search . '%');
            });
        }

        $colors = $query->paginate(12);

        return view('livewire.admin.color.index', [
            'colors' => $colors,
            'totalColors' => Color::count(),
        ])->layout('components.layouts.admin', ['title' => 'Colors Management']);
    }
}
