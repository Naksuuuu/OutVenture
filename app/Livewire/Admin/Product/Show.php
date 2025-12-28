<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;

class Show extends Component
{
    public $product;

    public function mount($productId)
    {
        $this->product = Product::with(['category', 'brand', 'variants.specs.size', 'variants.color'])
            ->findOrFail($productId);
    }

    public function render()
    {
        return view('livewire.admin.product.show', [
            'product' => $this->product,
        ])->layout('components.layouts.admin', ['title' => 'Product Details']);
    }
}
