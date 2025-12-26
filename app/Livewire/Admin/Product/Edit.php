<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\SizeValue;
use App\Models\ProductVariant;
use App\Models\ProductVariantSpec;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
  use WithFileUploads;

  public $product;
  public $nama_product;
  public $id_brand;
  public $id_category;
  public $deskripsi;
  public $variant_colors = [];
  public $prices = [];
  public $skus_spec = [];
  public $stocks = [];
  public $variant_old_images = [];
  public $variant_new_images = [];

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

    foreach ($this->product->variants as $variant) {
      $this->variant_colors[$variant->id] = $variant->id_color;
      $this->variant_old_images[$variant->id] = $variant->image;
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

    foreach ($this->variant_new_images as $variantId => $image) {
      if ($image) {
        $this->validateOnly('variant_new_images.' . $variantId, [
          'variant_new_images.' . $variantId => 'image|max:2048'
        ]);
      }
    }

    foreach ($this->variant_colors as $variantId => $colorId) {
      $updateData = ['id_color' => $colorId];
      
      if (isset($this->variant_new_images[$variantId]) && $this->variant_new_images[$variantId]) {
        if (!empty($this->variant_old_images[$variantId])) {
          Storage::disk('public')->delete($this->variant_old_images[$variantId]);
        }
        $updateData['image'] = $this->variant_new_images[$variantId]->store('variants', 'public');
      } else {
        $updateData['image'] = $this->variant_old_images[$variantId] ?? null;
      }
      
      ProductVariant::where('id', $variantId)->update($updateData);
    }

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

  public function deleteVariant($variantId)
  {
    $variant = ProductVariant::where('id', $variantId)
      ->where('id_product', $this->product->id)
      ->first();

    if (!$variant) {
      session()->flash('success', 'Varian tidak ditemukan.');
      return;
    }

    if ($variant->specs()->exists()) {
      session()->flash('success', 'Varian masih memiliki spesifikasi, hapus spesifikasi terlebih dahulu.');
      return;
    }

    if ($variant->image) {
      Storage::disk('public')->delete($variant->image);
    }

    $variant->delete();

    $this->refreshProduct();

    session()->flash('success', 'Varian berhasil dihapus.');
  }

  public function refreshProduct()
  {
    $this->product = Product::with(['category', 'brand', 'variants.specs', 'variants.color'])
      ->findOrFail($this->product->id);

    $this->variant_colors = [];
    $this->variant_old_images = [];
    $this->variant_new_images = [];

    foreach ($this->product->variants as $variant) {
      $this->variant_colors[$variant->id] = $variant->id_color;
      $this->variant_old_images[$variant->id] = $variant->image;
    }
  }

  public function render()
  {
    $categories = Category::all();
    $brands = Brand::all();
    $colors = Color::all();
    $sizes = SizeValue::where('id_size_group', $this->product->category->id_size_group)->get();

    return view('livewire.admin.product.edit', [
      'categories' => $categories,
      'brands' => $brands,
      'colors' => $colors,
      'sizes' => $sizes,
      'variant_colors' => $this->variant_colors,
      'variant_old_images' => $this->variant_old_images,
      'variant_new_images' => $this->variant_new_images,
    ])->layout('components.layouts.admin', ['title' => 'Edit Product']);
  }
}
