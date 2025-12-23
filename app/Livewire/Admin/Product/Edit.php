<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductVariant;
use App\Models\ProductVariantSpec;

class Edit extends Component
{
  public $product;
  public $nama_product;
  public $id_brand;
  public $id_category;
  public $deskripsi;
  public $variant_colors = [];
  public $prices = [];
  public $skus_spec = [];
  public $stocks = [];

  protected $listeners = ['variant-created' => 'refreshProduct', 'spec-events' => 'refreshProduct'];

  protected $rules = [
    'nama_product' => 'required|string|max:255',
    'id_brand' => 'required',
    'id_category' => 'required',
    'deskripsi' => 'nullable|string',
  ];

  public function mount($productId)
  {
    $this->product = Product::with(['category', 'brand', 'variants.specs', 'variants.color'])->findOrFail($productId);
    $this->nama_product = $this->product->nama_product;
    $this->id_brand = $this->product->id_brand;
    $this->id_category = $this->product->id_category;
    $this->deskripsi = $this->product->deskripsi;

    // Load colors and prices for variants
    foreach ($this->product->variants as $variant) {
      $this->variant_colors[$variant->id] = $variant->id_color;
      foreach ($variant->specs as $spec) {
        $this->prices[$spec->id] = $spec->harga;
        $this->skus_spec[$spec->id] = $spec->sku;
        $this->stocks[$spec->id] = $spec->stok;
      }
    }
  }

  public function update()
  {
    $this->validate();

    // Update colors
    foreach ($this->variant_colors as $variantId => $colorId) {
      ProductVariant::where('id', $variantId)->update(['id_color' => $colorId]);
    }

    // Update prices and specs
    foreach ($this->prices as $specId => $hargaBaru) {
      ProductVariantSpec::where('id', $specId)->update([
        'sku' => $this->skus_spec[$specId],
        'harga' => $hargaBaru,
        'stok' => $this->stocks[$specId]
      ]);
    }

    $this->product->update([
      'nama_product' => $this->nama_product,
      'id_brand' => $this->id_brand,
      'id_category' => $this->id_category,
      'deskripsi' => $this->deskripsi,
    ]);

    session()->flash('success', 'Product updated successfully!');

    return redirect()->route('admin.products.index');
  }

  public function refreshProduct()
  {
    // Reload product dengan relasi terbaru
    $this->product->load(['variants.specs', 'variants.color']);
  }

  public function render()
  {
    $categories = Category::all();
    $brands = Brand::all();
    $colors = Color::all();
    $sizes = Size::where('id_category', $this->product->id_category)->get();

    return view('livewire.admin.product.edit', [
      'categories' => $categories,
      'brands' => $brands,
      'colors' => $colors,
      'sizes' => $sizes,
    ])->layout('components.layouts.admin', ['title' => 'Edit Product']);
  }
}
