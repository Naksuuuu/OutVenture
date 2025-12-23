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
    $query = Product::with(['category', 'variants.specs', 'brand'])->whereHas('variants', function ($variant) {
      $variant->whereHas('specs');
    });

    if ($this->category) {
      $query->whereHas('category', function ($q) {
        $q->where('name_category', $this->category);
      });
    }

    $products = $query->orderBy('id', 'desc')->paginate(12);

    return view('livewire.public.product.index', [
      'products' => $products
    ])->layout('components.layouts.app', ['title' => 'Products']);
  }
}
