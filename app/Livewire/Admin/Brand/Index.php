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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSort()
    {
        $this->resetPage();
    }



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
            ->simplePaginate(10);

        return view('livewire.admin.brand.index', [
            'brands' => $brands
        ])->layout('components.layouts.admin', ['title' => 'Brands Management']);
    }
}
