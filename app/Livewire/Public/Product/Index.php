<?php

namespace App\Livewire\Public\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class Index extends Component
{
  use WithPagination;

  public $category = '';

  protected $queryString = ['category'];

  public function mount()
  {
    if (request()->has('category')) {
      $this->category = request()->query('category');
    }
  }

  public function updatedCategory()
  {
    $this->resetPage();
  }

  public function render()
  {
    $query = Product::query()
      ->with([
        'category:id,nama_category',
        'brand:id,nama_brand',
        'variants:id,id_product,id_color,image'
      ])
      ->whereExists(function ($subquery) {
        $subquery->select(\DB::raw(1))
          ->from('product_variants')
          ->whereColumn('product_variants.id_product', 'products.id')
          ->whereExists(function ($specQuery) {
            $specQuery->select(\DB::raw(1))
              ->from('product_variant_specs')
              ->whereColumn('product_variant_specs.id_variant', 'product_variants.id');
          });
      });

    if ($this->category) {
      $query->whereHas('category', function ($q) {
        $q->where('nama_category', $this->category);
      });
    }

    $products = $query->orderBy('id', 'desc')->paginate(12);

    // Load specs untuk produk yang sudah di-paginate saja
    $products->load(['variants.specs:id,id_variant,harga,stok']);

    // Hitung harga minimum untuk setiap produk
    $products->getCollection()->transform(function ($product) {
      $allSpecs = $product->variants->flatMap->specs;
      $product->min_price = $allSpecs->isNotEmpty() ? $allSpecs->min('harga') : 0;
      $product->variants_count = $product->variants->count();
      return $product;
    });

    return view('livewire.public.product.index', [
      'products' => $products
    ])->layout('components.layouts.app', ['title' => 'Products']);
  }
}
