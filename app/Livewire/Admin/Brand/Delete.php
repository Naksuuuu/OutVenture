<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;

class Delete extends Component
{
  public $brand;
  public $errorMessage = '';

  public function mount($brand)
  {
    $this->brand = Brand::findOrFail($brand);
  }

  public function delete()
  {
    $this->errorMessage = '';

    if ($this->brand->products()->exists()) {
      $this->errorMessage = 'Merek masih memiliki produk, hapus atau pindahkan produk terlebih dahulu.';
      return;
    }

    $this->brand->delete();

    session()->flash('success', 'Merek berhasil dihapus!');

    return redirect()->route('admin.brands.index');
  }

  public function render()
  {
    return view('livewire.admin.brand.delete');
  }
}
