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


    public function mount($id)
    {
        $this->brand = Brand::where('is_trusted', true)
            ->findOrFail($id);
    }

    public function render()
    {
        $products = Product::where('id_brand', $this->brand->id)->with(['category', 'variants'])->has('variants')->withCount('variants')->withAggregate('allSpecs as min_price', 'harga', 'min')->paginate(3);

        return view('livewire.public.brand.show', [
            'products' => $products,
        ])->layout('components.layouts.app', ['title' => $this->brand->name]);
    }
}
