<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use Livewire\WithFileUploads;

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

  public function mount($brandId)
  {
    $this->brand = Brand::findOrFail($brandId);
    $this->nama_brand = $this->brand->nama_brand;
    $this->oldImage = $this->brand->image;
    $this->oldWideImage = $this->brand->wide_image;
    $this->oldLogo = $this->brand->logo;
    $this->is_trusted = $this->brand->is_trusted;
  }

  public function update()
  {
    $this->validate();

    $imagePath = $this->new_image ? $this->new_image->store('brands', 'public') : $this->oldImage;
    $wideImagePath = $this->new_wide_image ? $this->new_wide_image->store('brands', 'public') : $this->oldWideImage;
    $logoPath = $this->new_logo ? $this->new_logo->store('brands', 'public') : $this->oldLogo;

    $this->brand->update([
      'nama_brand' => $this->nama_brand,
      'image' => $imagePath,
      'wide_image' => $wideImagePath,
      'logo' => $logoPath,
      'is_trusted' => (bool) $this->is_trusted,
    ]);

    session()->flash('success', 'Brand updated successfully!');

    return redirect()->route('admin.brands.index');
  }

  public function render()
  {
    return view('livewire.admin.brand.edit')
      ->layout('components.layouts.admin', ['title' => 'Edit Brand']);
  }
}
