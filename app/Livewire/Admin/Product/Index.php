<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;
use App\Models\Product;

class Index extends Component
{
  use WithPagination;

  public $search = '';
  public $category = '';

  protected $queryString = ['search', 'category'];

  public function updatingSearch()
  {
    $this->resetPage();
  }

  public function updatingCategory()
  {
    $this->resetPage();
  }

  public function deleteProduct($productId)
  {
    $product = Product::find($productId);
    if ($product) {
      $product->delete();
      session()->flash('success', 'Product deleted successfully!');
    }
  }

  public function render()
  {
    $query = Product::with(['category', 'variants', 'brand'])->orderBy('id', 'desc');

    if ($this->category) {
      $query->whereHas('category', function ($q) {
        $q->where('nama_category', $this->category);
      });
    }

    if ($this->search) {
      $query->where('nama_product', 'like', '%' . $this->search . '%');
    }

    $cacheKey = 'admin_products_total_' . md5($this->search . '|' . $this->category);
    $totalProducts = Cache::remember($cacheKey, 10, function () use ($query) {
      return $query->toBase()->getCountForPagination();
    });

    $products = $query->simplePaginate(12);

    return view('livewire.admin.product.index', [
      'products' => $products,
      'totalProducts' => $totalProducts,
    ])->layout('components.layouts.admin', ['title' => 'Products Management']);
  }
}
