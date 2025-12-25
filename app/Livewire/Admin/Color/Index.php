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

    public function getColorHex($colorName)
    {
        $colorMap = [
            'merah' => '#DC2626',
            'biru' => '#2563EB',
            'hijau' => '#16A34A',
            'kuning' => '#EAB308',
            'orange' => '#F97316',
            'ungu' => '#9333EA',
            'pink' => '#EC4899',
            'coklat' => '#92400E',
            'hitam' => '#000000',
            'putih' => '#FFFFFF',
            'abu-abu' => '#6B7280',
            'abu' => '#6B7280',
            'silver' => '#C0C0C0',
            'gold' => '#FFD700',
            'navy' => '#000080',
            'maroon' => '#800000',
            'tosca' => '#40E0D0',
            'cream' => '#FFFDD0',
        ];

        $key = strtolower(trim($colorName));
        return $colorMap[$key] ?? strtolower($colorName);
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
            $query->where('nama_warna', 'like', '%' . $this->search . '%');
        }

        $colors = $query->paginate(12);

        return view('livewire.admin.color.index', [
            'colors' => $colors,
            'totalColors' => Color::count(),
        ])->layout('components.layouts.admin', ['title' => 'Colors Management']);
    }
}
