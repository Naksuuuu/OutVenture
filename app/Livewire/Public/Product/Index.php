<?php
//  halaman ini belum beres logic nya
namespace App\Livewire\Public\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Brand;

class Index extends Component
{
  use WithPagination;

  public $selectedCategory = '';
  public $selectedBrand = '';
  public $selectedColor = '';
  public $selectedSize = '';
  public $selectedSort = 'latest';

  protected $queryString = [
    'selectedCategory' => ['except' => ''],
    'selectedBrand' => ['except' => ''],
    'selectedColor' => ['except' => ''],
    'selectedSize' => ['except' => ''],
    'selectedSort' => ['except' => 'latest']
  ];


  public function updatedSelectedSort()
  {
    $this->resetPage();
  }

  public function updatedSelectedCategory()
  {
    $this->resetPage();
  }

  public function updatedSelectedBrand()
  {
    $this->resetPage();
  }

  public function updatedSelectedColor()
  {
    $this->resetPage();
  }

  public function updatedSelectedSize()
  {
    $this->resetPage();
  }

  public function clearFilters()
  {
    $this->selectedCategory = '';
    $this->selectedBrand = '';
    $this->selectedColor = '';
    $this->selectedSize = '';
    $this->selectedSort = 'latest';
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
      ->has('variants.specs');

    // Filter by category
    if ($this->selectedCategory) {
      $query->where('id_category', $this->selectedCategory);
    }

    // Filter by brand
    if ($this->selectedBrand) {
      $query->where('id_brand', $this->selectedBrand);
    }

    // Filter by color
    if ($this->selectedColor) {
      $query->whereHas('variants', function ($q) {
        $q->where('id_color', $this->selectedColor);
      });
    }

    // Filter by size
    if ($this->selectedSize) {
      $query->whereHas('variants.specs', function ($q) {
        $q->where('id_size_value', $this->selectedSize);
      });
    }


    $direction = ($this->selectedSort === 'latest') ? 'desc' : 'asc';


    $products = $query->orderBy('created_at', $direction)
      ->paginate(12);

    // Load specs untuk produk yang sudah di-paginate saja
    $products->load(['variants.specs:id,id_variant,harga,stok']);

    // Hitung harga minimum untuk setiap produk
    $products->getCollection()->transform(function ($product) {
      $allSpecs = $product->variants->flatMap->specs;
      $product->min_price = $allSpecs->isNotEmpty() ? $allSpecs->min('harga') : 0;
      $product->variants_count = $product->variants->count();
      return $product;
    });

    // Get available categories and colors for filter
    $categories = Category::orderBy('nama_category')->get();
    $allBrands = Brand::orderBy('nama_brand')->get();
    $colors = Color::orderBy('nama_warna')->get();

    // Get sizes based on selected category
    $sizes = collect();
    if ($this->selectedCategory) {
      $category = Category::with('sizeGroup.values')->find($this->selectedCategory);
      if ($category && $category->sizeGroup) {
        $sizes = $category->sizeGroup->values()->orderBy('sort_order')->get();
      }
    }

    // Get featured brands for hero
    $brands = Brand::where('is_trusted', true)
      ->orderBy('is_trusted', 'desc')
      ->limit(4)
      ->get();

    return view('livewire.public.product.index', [
      'brands' => $brands,
      'allBrands' => $allBrands,
      'products' => $products,
      'categories' => $categories,
      'colors' => $colors,
      'sizes' => $sizes
    ])->layout('components.layouts.app', ['title' => 'Products']);
  }
}
