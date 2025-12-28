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

    session()->flash('success', 'Merek Berhasil Dibuat!');

    return redirect()->route('admin.brands.index');
  }

  public function render()
  {
    return view('livewire.admin.brand.create')
      ->layout('components.layouts.admin', ['title' => 'Create Brand']);
  }
}
