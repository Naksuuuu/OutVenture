<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;

class Delete extends Component
{

    public $product;
    public $errorMessage = '';

    public function mount($product)
    {
        $this->product = Product::findOrFail($product);
    }
    
    public function delete()
    {
        if ($this->product->variants()->exists()) {
            $this->errorMessage = 'Produk masih memiliki varian, hapus varian terlebih dahulu.';
            return;
        }

        $this->product->delete();

        return redirect()->route('admin.products.index')->with('notifySuccess', 'Product Berhasil Dihapus!');
    }

    public function render()
    {
        return view('livewire.admin.product.delete');
    }
}
