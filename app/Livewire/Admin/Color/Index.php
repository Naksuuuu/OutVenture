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

    public function deleteColor($colorId)
    {
        try {
            $color = Color::find($colorId);

            if (!$color) {
                $this->errorMessage = 'Warna tidak ditemukan!';
                $this->dispatch('close-message');
                return;
            }

            if ($color->productVariants->count() > 0) {
                $this->errorMessage = 'Warna tidak dapat dihapus karena masih digunakan pada ' . $color->productVariants->count() . ' varian produk!';
                $this->dispatch('close-message');
                return;
            }

            $color->delete();
            $this->successMessage = 'Warna berhasil dihapus!';
            $this->dispatch('close-message');
        } catch (\Exception $e) {
            $this->errorMessage = 'Terjadi kesalahan: ' . $e->getMessage();
            $this->dispatch('close-message');
        }
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
