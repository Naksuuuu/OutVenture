<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use Livewire\WithFileUploads;

class Create extends Component
{

  use WithFileUploads;

  public $nama_brand = '';
  public $image;
  public $wide_image;
  public $logo;
  public $is_trusted = false;

  protected $rules = [
    'nama_brand' => 'required|string|max:255',
    'image' => 'nullable|image|max:2048',
    'wide_image' => 'nullable|image|max:2048',
    'logo' => 'nullable|image|max:2048',
    'is_trusted' => 'boolean',
  ];

  protected $messages = [
    'nama_brand.required' => 'Nama brand wajib diisi.',
    'nama_brand.max' => 'Nama brand maksimal 255 karakter.',
    'image.image' => 'Thumbnail harus berupa gambar.',
    'image.max' => 'Ukuran thumbnail maksimal 2MB.',
    'wide_image.image' => 'Banner harus berupa gambar.',
    'wide_image.max' => 'Ukuran banner maksimal 2MB.',
    'logo.image' => 'Logo harus berupa gambar.',
    'logo.max' => 'Ukuran logo maksimal 2MB.',
  ];

  /**
   * Menyimpan data merek baru ke database.
   */
  public function save()
  {
    $this->validate();

    $imagePath = $this->image ? $this->image->store('brands', 'public') : null;
    $wideImagePath = $this->wide_image ? $this->wide_image->store('brands', 'public') : null;
    $logoPath = $this->logo ? $this->logo->store('brands', 'public') : null;

    Brand::create([
      'nama_brand' => $this->nama_brand,
      'image' => $imagePath,
      'wide_image' => $wideImagePath,
      'logo' => $logoPath,
      'is_trusted' => $this->is_trusted,
    ]);

    return redirect()->route('admin.brands.index')->with('notifySuccess', 'Merek Berhasil Dibuat!');
  }

  /**
   * Merender tampilan halaman pembuatan merek.
   */
  public function render()
  {
    return view('livewire.admin.brand.create')
      ->layout('components.layouts.admin', ['title' => 'Create Brand']);
  }
}
