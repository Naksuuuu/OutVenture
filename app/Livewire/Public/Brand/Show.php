<?php

namespace App\Livewire\Public\Brand;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $brand;


    public function mount(Brand $brand)
    {
        if (!$brand->is_trusted) {
            abort(404);
        }
        $this->brand = $brand;
    }

    public function render()
    {
        $products = Product::where('id_brand', $this->brand->id)->with(['category', 'variants'])->has('variants')->withCount('variants')->withAggregate('allSpecs as min_price', 'harga', 'min')->paginate(3);

        return view('livewire.public.brand.show', [
            'products' => $products,
        ])->layout('components.layouts.app', ['title' => $this->brand->nama_brand]);
    }
}
