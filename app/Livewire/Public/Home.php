<?php

namespace App\Livewire\Public;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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

    $latestProducts = Product::with(['brand', 'category', 'variants.specs'])
      ->has('variants') // Hanya produk yang punya variant
      ->whereHas('variants.specs') // Variant harus punya spec
      ->withCount('variants')
      ->latest()
      ->limit(10)
      ->get()
      ->map(function ($product) {
        // Calculate minimum price from all variant specs
        $minPrice = $product->variants->flatMap->specs->min('harga');
        $product->min_price = $minPrice ?? 0;
        return $product;
      });

    return view('livewire.public.home', [
      'brands' => $brands,
      'categories' => $categories,
      'latestProducts' => $latestProducts,
    ])->layout('components.layouts.app', ['title' => 'Outventure - Home']);
  }
}
