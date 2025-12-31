<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;

class Show extends Component
{

  public $brand;

  /**
   * Menyiapkan data brands detail.
   */
  public function mount(Brand $brand)
  {
    $this->brand = $brand;
  }

  /**
   * Merender tampilan detail merek.
   */
  public function render()
  {
    return view('livewire.admin.brand.show', ['brand' => $this->brand])->layout('components.layouts.admin', ['title' => 'Brand Details']);
  }
}
