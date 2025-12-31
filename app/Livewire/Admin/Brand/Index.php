<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\Brand;

class Index extends Component
{
    use WithPagination;

    public $errorMessage = '';

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(history: true, keep: true)]
    public $sort = 'latest';

    /**
     * Mereset halaman pagination saat kata kunci pencarian berubah.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Mereset halaman pagination saat urutan sorting berubah.
     */
    public function updatingSort()
    {
        $this->resetPage();
    }



    /**
     * Menghapus data merek dari database.
     */
    public function delete($id)
    {
        $this->errorMessage = '';
        $brand = Brand::find($id);


        if (!$brand) {
            $this->errorMessage = 'Data tidak ditemukan.';
            return;
        }

        if ($brand->products()->exists()) {
            $this->errorMessage = 'Merek masih memiliki produk, hapus atau pindahkan produk terlebih dahulu.';
            return;
        }

        $brand->delete();

        $this->dispatch('delete-success');
        $this->dispatch('notify', type: 'success', message: 'Brand berhasil dihapus!');
    }

    /**
     * Merender tampilan daftar merek dengan fitur pencarian dan sorting.
     */
    public function render()
    {
        $brands = Brand::query()
            ->when($this->search, function ($query) {
                $query->where('nama_brand', 'like', '%' . $this->search . '%');
            })
            ->withCount('products')
            ->when($this->sort === 'latest', function ($query) {
                $query->latest();
            }, function ($query) {
                $query->oldest();
            })
            ->paginate(8);

        return view('livewire.admin.brand.index', [
            'brands' => $brands
        ])->layout('components.layouts.admin', ['title' => 'Brands Management']);
    }
}
