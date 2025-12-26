<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;

class Delete extends Component
{

  public $brand;

  public function mount($brand)
  {
    $this->brand = Brand::findOrFail($brand);
  }
  public function delete()
  {
    if ($this->brand->products()->exists()) {
      session()->flash('error', 'Merek masih memiliki produk, hapus atau pindahkan produk terlebih dahulu.');
      return redirect()->route('admin.brands.index');
    }

    $this->brand->delete();

    session()->flash('success', 'Brand deleted successfully!');

    return redirect()->route('admin.brands.index');
  }

  public function render()
  {
    return view('livewire.admin.brand.delete');
  }
}
