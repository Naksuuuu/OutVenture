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

  public function mount(Brand $brand)
  {
    $this->brand = $brand;
    $this->nama_brand = $this->brand->nama_brand;
    $this->oldImage = $this->brand->image;
    $this->oldWideImage = $this->brand->wide_image;
    $this->oldLogo = $this->brand->logo;
    $this->is_trusted = $this->brand->is_trusted;
  }

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

    return redirect()->route('admin.brands.index')->with('notifySuccess', 'Merek Berhasil Diperbarui!');
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

  public function render()
  {
    return view('livewire.admin.brand.edit')
      ->layout('components.layouts.admin', ['title' => 'Edit Brand']);
  }
}
