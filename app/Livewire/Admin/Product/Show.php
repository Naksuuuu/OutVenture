<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;

class Show extends Component
{
    public $product;

    public function mount(Product $product)
    {
        $this->product = $product->load(['category', 'brand', 'variants.specs.size', 'variants.color']);
    }

    public function render()
    {
        return view('livewire.admin.product.show', [
            'product' => $this->product,
        ])->layout('components.layouts.admin', ['title' => 'Product Details']);
    }
}
