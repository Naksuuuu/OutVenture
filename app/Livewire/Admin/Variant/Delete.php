<?php

namespace App\Livewire\Admin\Variant;

use App\Models\ProductVariant;
use Livewire\Component;

class Delete extends Component
{

    public $variant;
    public function mount($variant)
    {
        $this->variant = $variant;
    }

    public function delete()
    {
        ProductVariant::destroy($this->variant);

        session()->flash('success', 'Varian produk berhasil dihapus!');

        return redirect()->route('admin.products.variants', ['product' => request()->route('product')]);
    }


    public function render()
    {
        return view('livewire.admin.variant.delete');
    }
}
