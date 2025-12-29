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
  public $successMessage = '';
  public $errorMessage = '';
  public $usedColorIds = [];

  protected $listeners = [
    'variant-created' => 'refreshProduct', 
    'spec-events' => 'refreshProduct', 
    'variant-deleted' => 'refreshProduct',
    'show-success-message' => 'showSuccessMessage'
  ];

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

    $this->usedColorIds = $this->product->variants->pluck('id_color')->unique()->toArray();
  }

  public function update()
  {
    $this->successMessage = '';
    $this->errorMessage = '';
    
    try {
      $this->validate();

      if ($this->product->variants()->exists() && $this->id_category != $this->product->id_category) {
        $this->addError('id_category', 'Kategori tidak dapat diubah karena produk memiliki varian. Hapus semua varian terlebih dahulu.');
        $this->errorMessage = 'Kategori tidak dapat diubah karena produk memiliki varian.';
        return;
      }

      foreach ($this->variant_new_images as $variantId => $image) {
        if ($image) {
          $this->validateOnly('variant_new_images.' . $variantId, [
            'variant_new_images.' . $variantId => 'image|max:2048'
          ]);
        }
      }

      foreach ($this->variant_colors as $variantId => $colorId) {
        $variant = $this->product->variants->firstWhere('id', $variantId);
        if ($variant) {
          $hasSpecs = $variant->specs->count() > 0;
          $isChangingColor = $colorId != $variant->id_color;
          if ($hasSpecs && $isChangingColor) {
            $this->addError('variant_colors.' . $variantId, 'Warna varian tidak dapat diubah karena varian memiliki spesifikasi. Hapus spesifikasi terlebih dahulu.');
            $this->errorMessage = 'Tidak bisa ubah warna varian yang memiliki spesifikasi.';
            return;
          }

          $isColorUsedByOther = $this->product->variants
            ->where('id', '!=', $variantId)
            ->pluck('id_color')
            ->contains($colorId);
          if ($isChangingColor && $isColorUsedByOther) {
            $this->addError('variant_colors.' . $variantId, 'Warna ini sudah digunakan oleh varian lain pada produk ini.');
            $this->errorMessage = 'Warna sudah digunakan oleh varian lain.';
            return;
          }
        }

        $updateData = ['id_color' => $colorId];

        if (isset($this->variant_new_images[$variantId]) && $this->variant_new_images[$variantId]) {
          $oldPath = $this->variant_old_images[$variantId] ?? null;
          $newPath = $this->variant_new_images[$variantId]->store('variants', 'public');
          $updateData['image'] = $newPath;
          
          if ($oldPath && $oldPath !== $newPath) {
            $this->deletePublicFile($oldPath);
          }
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

      $this->product = Product::with(['category', 'brand', 'variants.specs', 'variants.color'])
        ->findOrFail($this->product->id);
      
      $this->variant_new_images = [];

      $this->successMessage = 'Produk berhasil diperbarui!';
    } catch (\Exception $e) {
      $this->errorMessage = 'Gagal memperbarui produk: ' . $e->getMessage();
    }
  }

  protected function deletePublicFile(?string $path): void
  {
    if (!$path) return;
    try {
      if (Storage::disk('public')->exists($path)) {
        Storage::disk('public')->delete($path);
      }
    } catch (\Exception $e) {
      $full = public_path('storage/' . ltrim($path, '/'));
      if (is_file($full)) {
        @unlink($full);
      }
    }
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

    $this->usedColorIds = $this->product->variants->pluck('id_color')->unique()->toArray();
  }

  public function showSuccessMessage($message)
  {
    $this->successMessage = $message;
    $this->errorMessage = '';
  }

  public function resetMessages()
  {
    $this->successMessage = '';
    $this->errorMessage = '';
  }

  public function delete($id)
  {
    $this->errorMessage = '';

    $spec = ProductVariantSpec::find($id);
    if ($spec) {
      try {
        $spec->delete();
        $this->dispatch('delete-success');
        $this->dispatch('spec-events');
        $this->dispatch('notify', type: 'success', message: 'Spesifikasi berhasil dihapus!');
        $this->refreshProduct();
        return;
      } catch (\Exception $e) {
        $this->errorMessage = 'Gagal menghapus spesifikasi.';
        return;
      }
    }

    $variant = ProductVariant::with('specs')->find($id);
    if ($variant) {
      $hasSpecs = ProductVariantSpec::where('id_variant', $variant->id)->exists();

      if ($hasSpecs) {
        $this->errorMessage = 'Varian masih memiliki spesifikasi, hapus spesifikasi terlebih dahulu.';
        return;
      }

      try {
        if ($variant->image) {
          $this->deletePublicFile($variant->image);
        }
        $variant->delete();
        $this->dispatch('delete-success');
        $this->dispatch('variant-deleted');
        $this->dispatch('variant-created');
        $this->dispatch('notify', type: 'success', message: 'Varian berhasil dihapus!');
        $this->refreshProduct();
        return;
      } catch (\Exception $e) {
        $this->errorMessage = 'Gagal menghapus varian.';
        return;
      }
    }

    $this->errorMessage = 'Data tidak ditemukan.';
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
      'usedColorIds' => $this->usedColorIds,
      'variant_colors' => $this->variant_colors,
      'variant_old_images' => $this->variant_old_images,
      'variant_new_images' => $this->variant_new_images,
      'successMessage' => $this->successMessage,
      'errorMessage' => $this->errorMessage,
    ])->layout('components.layouts.admin', ['title' => 'Edit Product']);
  }
}
