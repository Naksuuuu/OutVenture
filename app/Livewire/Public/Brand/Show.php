<?php

namespace App\Livewire\Public\Brand;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $brand;

    public $selectedCategory = '';
    public $selectedColor = '';
    public $selectedSize = '';
    public $selectedSort = 'latest';

    protected $queryString = [
        'selectedCategory' => ['except' => ''],
        'selectedColor' => ['except' => ''],
        'selectedSize' => ['except' => ''],
        'selectedSort' => ['except' => 'latest']
    ];

    public function mount(Brand $brand)
    {
        if (!$brand->is_trusted) {
            abort(404);
        }
        $this->brand = $brand;
    }

    public function updatedSelectedSort()
    {
        $this->resetPage();
    }

    public function updatedSelectedCategory()
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
        $this->selectedColor = '';
        $this->selectedSize = '';
        $this->selectedSort = 'latest';
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query()
            ->where('id_brand', $this->brand->id)
            ->with([
                'category:id,nama_category',
                'variants:id,id_product,id_color,image'
            ])
            ->has('variants.specs');

        // Filter by category
        if ($this->selectedCategory) {
            $query->where('id_category', $this->selectedCategory);
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
        // Only show categories that have products in this brand
        $categories = Category::whereHas('products', function ($q) {
            $q->where('id_brand', $this->brand->id);
        })->orderBy('nama_category')->get();

        $colors = Color::orderBy('nama_warna')->get();

        // Get sizes based on selected category
        $sizes = collect();
        if ($this->selectedCategory) {
            $category = Category::with('sizeGroup.values')->find($this->selectedCategory);
            if ($category && $category->sizeGroup) {
                $sizes = $category->sizeGroup->values()->orderBy('sort_order')->get();
            }
        }

        return view('livewire.public.brand.show', [
            'products' => $products,
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes
        ])->layout('components.layouts.app', ['title' => $this->brand->nama_brand]);
    }
}
