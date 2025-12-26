<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\Brand;

class Index extends Component
{
    use WithPagination;

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

    public function deleteBrand($brandId)
    {
        $brand = Brand::find($brandId);
        if ($brand) {
            $brand->delete();
            session()->flash('success', 'Brand deleted successfully!');
        }
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
