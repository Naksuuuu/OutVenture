<?php

namespace App\Livewire\Admin\Spec;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantSpec;
use App\Models\Size;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Create extends Component
{

    public $product;
    public $variant;
    public $id_size;
    public $harga;
    public $sku;
    public $stok;
    public $isOpen;

    protected $rules = [
        'id_size' => 'required|exists:Size,id',
        'harga' => 'required|numeric|min:0',
        'sku' => 'required|string|max:100|unique:ProductVariantSpec,sku',
        'stok' => 'required|integer|min:0',
    ];

    public function mount(Product $product, ProductVariant $variant)
    {
        $this->isOpen = false;
        $this->product = $product;
        $this->variant = $variant;
    }

    public function save()
    {

        $this->validate();

        ProductVariantSpec::create([
            'id_variant' => $this->variant->id,
            'id_size' => $this->id_size,
            'harga' => $this->harga,
            'sku' => strtoupper($this->sku),
            'stok' => $this->stok,
        ]);

        $this->dispatch('spec-events');
        $this->reset(['id_size', 'harga', 'sku', 'stok']);
        $this->isOpen = false;

        $this->dispatch('show-alert', message: 'Spesifikasi berhasil ditambahkan!');
    }


    public function render()
    {
        return view('livewire.admin.spec.create', [
            'sizes' => Size::where('id_category', $this->product->id_category)->get(),
        ]);
    }
}
