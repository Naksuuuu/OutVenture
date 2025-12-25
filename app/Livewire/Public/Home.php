<?php

namespace App\Livewire\Public;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Component;

class Home extends Component
{
  public function render()
  {
    $brands = Brand::withCount('products')
      ->orderBy('is_trusted', 'desc')
      ->limit(4)
      ->get();

    $categories = Category::withCount('products')
      ->orderBy('products_count', 'desc')
      ->get();

    $latestProducts = ProductVariant::with(['product.brand', 'product.category', 'color', 'specs'])
      ->whereHas('product')
      ->whereHas('specs')
      ->latest()
      ->limit(10)
      ->get();


    return view('livewire.public.home', [
      'brands' => $brands,
      'categories' => $categories,
      'latestProducts' => $latestProducts,
    ])->layout('components.layouts.app', ['title' => 'Outventure - Home']);
  }
}
