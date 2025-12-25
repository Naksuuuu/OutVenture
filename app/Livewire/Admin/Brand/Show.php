<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;

class Show extends Component
{

  public $brand;

  public function mount($brandId)
  {
    $this->brand = Brand::findOrFail($brandId);
  }

  public function render()
  {
    return view('livewire.admin.brand.show', ['brand' => $this->brand])->layout('components.layouts.admin', ['title' => 'Brand Details']);
  }
}
