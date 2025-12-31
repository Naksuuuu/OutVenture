<?php

namespace App\Livewire\Admin\Variant;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
  use WithFileUploads;

  public $variant;
  public $product;
  public $id_color;
  public $image;
  public $old_image;
  public $isOpen = false;

  protected $rules = [
    'id_color' => 'required|exists:colors,id',
    'image' => 'nullable|image|max:2048',
  ];

  protected $messages = [
    'id_color.required' => 'Warna wajib dipilih.',
    'id_color.exists' => 'Warna tidak valid.',
    'image.image' => 'File harus berupa gambar.',
    'image.max' => 'Ukuran gambar maksimal 2MB.',
  ];

  public function mount(ProductVariant $variant, Product $product)
  {
    $this->variant = $variant;
    $this->product = $product;
    $this->id_color = $variant->id_color;
    $this->old_image = $variant->image;
  }

  public function save()
  {
    $this->validate();

    // Cek duplicate color di produk yang sama (kecuali diri sendiri)
    $isDuplicate = ProductVariant::where('id_product', $this->product->id)
      ->where('id', '!=', $this->variant->id)
      ->where('id_color', $this->id_color)
      ->exists();

    if ($isDuplicate) {
      $this->addError('id_color', 'Warna ini sudah digunakan oleh varian lain.');
      return;
    }


    if ($this->variant->specs()->exists() && $this->variant->id_color != $this->id_color) {
      $this->addError('id_color', 'Warna tidak bisa diubah karena varian ini sudah memiliki spesifikasi. Hapus spesifikasi dulu jika ingin ganti warna.');
      return;
    }

    $data = [
      'id_color' => $this->id_color,
    ];

    if ($this->image) {
      if ($this->old_image) {
        Storage::disk('public')->delete($this->old_image);
      }
      $imagePath = $this->image->store('variants', 'public');
      $data['image'] = $imagePath;

      // Update old_image agar jika diedit lagi, yang dihapus adalah gambar yang baru
      $this->old_image = $imagePath;
      $this->reset('image');
    }

    $this->variant->update($data);

    $this->dispatch('variant-updated'); // Event untuk refresh list di parent dashboard
    $this->dispatch('notify', type: 'success', message: 'Varian berhasil diperbarui!');
    $this->isOpen = false;
  }

  public function render()
  {
    // Ambil warna yang SUDAH kepakai di varian lain (biar bisa di-disable di option)
    $usedColorIds = $this->product->variants
      ->where('id', '!=', $this->variant->id)
      ->pluck('id_color')
      ->toArray();

    $colors = Color::all();

    return view('livewire.admin.variant.edit', [
      'colors' => $colors,
      'usedColorIds' => $usedColorIds,
    ]);
  }
}
