<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{

  use WithFileUploads;

  public $brand;
  public $nama_brand;
  public $oldImage;
  public $oldWideImage;
  public $oldLogo;
  public $new_image;
  public $new_wide_image;
  public $new_logo;
  public $is_trusted;

  protected $rules = [
    'nama_brand' => 'required|string|max:255',
    'new_image' => 'nullable|image|max:2048',
    'new_wide_image' => 'nullable|image|max:2048',
    'new_logo' => 'nullable|image|max:2048',
    'is_trusted' => 'boolean',
  ];

  protected $messages = [
    'nama_brand.required' => 'Nama brand wajib diisi.',
    'nama_brand.max' => 'Nama brand maksimal 255 karakter.',
    'new_image.image' => 'Thumbnail harus berupa gambar.',
    'new_image.max' => 'Ukuran thumbnail maksimal 2MB.',
    'new_wide_image.image' => 'Banner harus berupa gambar.',
    'new_wide_image.max' => 'Ukuran banner maksimal 2MB.',
    'new_logo.image' => 'Logo harus berupa gambar.',
    'new_logo.max' => 'Ukuran logo maksimal 2MB.',
  ];

  /**
   * Menyiapkan data awal merek yang akan diedit.
   */
  public function mount(Brand $brand)
  {
    $this->brand = $brand;
    $this->nama_brand = $this->brand->nama_brand;
    $this->oldImage = $this->brand->image;
    $this->oldWideImage = $this->brand->wide_image;
    $this->oldLogo = $this->brand->logo;
    $this->is_trusted = $this->brand->is_trusted;
  }

  /**
   * Memperbarui data merek ke database.
   */
  public function update()
  {
    $this->validate();

    $imagePath = $this->oldImage;
    if ($this->new_image) {
      $newPath = $this->new_image->store('brands', 'public');
      $imagePath = $newPath;
      if ($this->oldImage && $this->oldImage !== $newPath) {
        $this->deletePublicFile($this->oldImage);
      }
    }

    $wideImagePath = $this->oldWideImage;
    if ($this->new_wide_image) {
      $newPath = $this->new_wide_image->store('brands', 'public');
      $wideImagePath = $newPath;
      if ($this->oldWideImage && $this->oldWideImage !== $newPath) {
        $this->deletePublicFile($this->oldWideImage);
      }
    }

    $logoPath = $this->oldLogo;
    if ($this->new_logo) {
      $newPath = $this->new_logo->store('brands', 'public');
      $logoPath = $newPath;
      if ($this->oldLogo && $this->oldLogo !== $newPath) {
        $this->deletePublicFile($this->oldLogo);
      }
    }

    $this->brand->update([
      'nama_brand' => $this->nama_brand,
      'image' => $imagePath,
      'wide_image' => $wideImagePath,
      'logo' => $logoPath,
      'is_trusted' => (bool) $this->is_trusted,
    ]);

    $this->reset(['new_image', 'new_wide_image', 'new_logo']);

    $this->dispatch('notify', type: 'success', message: 'Merek berhasil diperbarui!');
    $this->refreshBrand();
  }


  /**
   * Memuat ulang data merek dari database.
   */
  public function refreshBrand()
  {
    $this->brand->refresh();
  }

  /**
   * Menghapus file gambar dari penyimpanan publik.
   */
  protected function deletePublicFile(?string $path): void
  {
    if (!$path)
      return;
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

  /**
   * Merender tampilan halaman edit merek.
   */
  public function render()
  {
    return view('livewire.admin.brand.edit')
      ->layout('components.layouts.admin', ['title' => 'Edit Brand']);
  }
}
