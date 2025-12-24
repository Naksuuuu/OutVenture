<?php

namespace App\Livewire\Admin\Spec;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantSpec;
use App\Models\SizeValue;
use Livewire\Component;

class Edit extends Component
{

    public $spec;
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
        'sku' => 'required|string|max:100',
        'stok' => 'required|integer|min:0',
    ];

    public function mount(ProductVariantSpec $spec, Product $product, ProductVariant $variant)
    {
        $this->isOpen = false;
        $this->spec = $spec;
        $this->variant = $variant;
        $this->product = $product;
        $this->sku = $this->spec->sku;
        $this->id_size_value = $this->spec->id_size_value;
        $this->harga = $this->spec->harga;
        $this->stok = $this->spec->stok;
    }

    public function save()
    {

        $this->validate();

        ProductVariantSpec::where('id', $this->spec->id)->update([
            'id_variant' => $this->variant->id,
            'id_size_value' => $this->id_size_value,
            'harga' => $this->harga,
            'sku' => strtoupper($this->sku),
            'stok' => $this->stok,
        ]);

        $this->dispatch('spec-events');
        $this->reset(['id_size', 'harga', 'sku', 'stok']);
        $this->isOpen = false;

        $this->dispatch('show-alert', message: 'Spesifikasi berhasil dirubah');
    }


    public function render()
    {
        return view('livewire.admin.spec.edit', [
            'sizes' => SizeValue::where('id_size_group', $this->product->category->id_size_group)->get(),
        ]);
    }
}
