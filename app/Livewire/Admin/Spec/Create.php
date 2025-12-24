<?php

namespace App\Livewire\Admin\Spec;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantSpec;
use App\Models\SizeValue;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Create extends Component
{

    public $product;
    public $variant;
    public $id_size_value;
    public $harga;
    public $sku;
    public $stok;
    public $isOpen;

    protected $rules = [
        'id_size_value' => 'required|exists:size_values,id',
        'harga' => 'required|numeric|min:0',
        'sku' => 'required|string|max:100|unique:product_variant_specs,sku',
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
            'id_size_value' => $this->id_size_value,
            'harga' => $this->harga,
            'sku' => strtoupper($this->sku),
            'stok' => $this->stok,
        ]);

        $this->dispatch('spec-events');
        $this->reset(['id_size', 'harga', 'sku', 'stok']);
        $this->isOpen = false;

        session()->flash('success', 'Spesifikasi berhasil ditambahkan!');
    }


    public function render()
    {
        return view('livewire.admin.spec.create', [
            'sizes' => SizeValue::where('id_size_group', $this->product->category->id_size_group)->get(),
        ]);
    }
}
