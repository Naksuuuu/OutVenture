<?php

namespace App\Livewire\Public\Product;

use Livewire\Component;
use App\Models\Product;

class Show extends Component
{
  public $product;

  public function mount($id)
  {
    $this->product = Product::with([
      'category', 
      'brand',
      'variants.color',
      'variants.specs.size'
    ])->findOrFail($id);
  }

  public function render()
  {
    return view('livewire.public.product.show')
      ->layout('components.layouts.app', ['title' => $this->product->nama_product]);
  }
}
