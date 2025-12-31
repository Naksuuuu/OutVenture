<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class Edit extends Component
{
  public $product;
  public $nama_product;
  public $id_brand;
  public $id_category;
  public $deskripsi;
  public $successMessage = '';
  public $errorMessage = '';

  protected $rules = [
    'nama_product' => 'required|string|min:2|max:255',
    'id_brand' => 'required',
    'id_category' => 'required',
    'deskripsi' => 'nullable|string',
  ];

  protected $listeners = [
    'variant-created' => 'refreshProduct',
    'variant-deleted' => 'refreshProduct',
    'spec-events' => 'refreshProduct',
  ];

  /**
   * Menyiapkan data awal produk yang akan diedit.
   */
  public function mount(Product $product)
  {
    $this->product = $product->load(['category', 'brand']);
    $this->nama_product = $this->product->nama_product;
    $this->id_brand = $this->product->id_brand;
    $this->id_category = $this->product->id_category;
    $this->deskripsi = $this->product->deskripsi;
  }

  /**
   * Memperbarui data produk utama ke database.
   */
  public function updateProduct()
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

      $this->product->update([
        'nama_product' => $this->nama_product,
        'id_brand' => $this->id_brand,
        'id_category' => $this->id_category,
        'deskripsi' => $this->deskripsi,
      ]);

      $this->product = Product::with(['category', 'brand'])->findOrFail($this->product->id);
      $this->dispatch('notify', type: 'success', message: 'Produk berhasil diperbarui!');
      $this->successMessage = 'Produk berhasil diperbarui!';
    } catch (\Exception $e) {
      $this->errorMessage = 'Gagal memperbarui produk: ' . $e->getMessage();
    }
  }

  /**
   * Memuat ulang data produk.
   */
  public function refreshProduct()
  {
    $this->product = Product::with(['category', 'brand'])->findOrFail($this->product->id);
  }

  /**
   * Menghapus spesifikasi atau varian produk.
   */
  public function delete($id)
  {
    $this->errorMessage = '';

    $spec = \App\Models\ProductVariantSpec::find($id);
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

    $variant = \App\Models\ProductVariant::with('specs')->find($id);
    if ($variant) {
      $hasSpecs = \App\Models\ProductVariantSpec::where('id_variant', $variant->id)->exists();

      if ($hasSpecs) {
        $this->errorMessage = 'Varian masih memiliki spesifikasi, hapus spesifikasi terlebih dahulu.';
        return;
      }

      try {
        if ($variant->image) {
          \Illuminate\Support\Facades\Storage::disk('public')->delete($variant->image);
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

  /**
   * Merender tampilan halaman edit produk.
   */
  public function render()
  {
    $categories = Category::all();
    $brands = Brand::all();

    return view('livewire.admin.product.edit', [
      'categories' => $categories,
      'brands' => $brands,
    ])->layout('components.layouts.admin', ['title' => 'Edit Product']);
  }
}
