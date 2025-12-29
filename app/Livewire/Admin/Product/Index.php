<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;
use App\Models\Product;

class Index extends Component
{
  use WithPagination;

  public $search = '';
  public $category = '';
  public $sort = 'latest';

  protected $queryString = ['search', 'category', 'sort'];

  public function updatingSearch()
  {
    $this->resetPage();
  }

  public function updatingCategory()
  {
    $this->resetPage();
  }

  public function updatingSort()
  {
    $this->resetPage();
  }

  public function render()
  {
    $allCategories = Category::pluck('nama_category', 'nama_category')->prepend('Kategori', '')->toArray();
    $query = Product::with(['category', 'variants', 'brand']);

    if ($this->sort === 'latest') {
      $query->latest();
    } else {
      $query->oldest();
    }

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

    $products = $query->paginate(12);

    return view('livewire.admin.product.index', [
      'products' => $products,
      'totalProducts' => $totalProducts,
      'allCategories' => $allCategories,
    ])->layout('components.layouts.admin', ['title' => 'Products Management']);
  }
}
