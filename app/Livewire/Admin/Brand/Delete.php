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
    $this->brand->delete();

    session()->flash('success', 'Brand deleted successfully!');

    return redirect()->route('admin.brands.index');
  }

  public function render()
  {
    return view('livewire.admin.brand.delete');
  }
}
