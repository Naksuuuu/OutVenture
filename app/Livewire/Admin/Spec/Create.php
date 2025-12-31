<?php

namespace App\Livewire\Admin\Spec;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantSpec;
use App\Models\SizeValue;
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

    protected function rules()
    {
        return [
            'id_size_value' => 'required|exists:size_values,id',
            'harga' => 'required|numeric|min:0',
            'sku' => 'required|string|max:100|unique:product_variant_specs,sku',
            'stok' => 'required|integer|min:0',
        ];
    }

    protected $messages = [
        'id_size_value.required' => 'Ukuran wajib dipilih.',
        'id_size_value.exists' => 'Ukuran tidak valid.',
        'harga.required' => 'Harga wajib diisi.',
        'harga.numeric' => 'Harga harus berupa angka.',
        'harga.min' => 'Harga tidak boleh kurang dari 0.',
        'sku.required' => 'SKU wajib diisi.',
        'sku.unique' => 'SKU sudah digunakan.',
        'stok.required' => 'Stok wajib diisi.',
        'stok.integer' => 'Stok harus berupa angka bulat.',
        'stok.min' => 'Stok tidak boleh kurang dari 0.',
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
        $this->reset(['id_size_value', 'harga', 'sku', 'stok']);
        $this->isOpen = false;

        $this->dispatch('notify', type: 'success', message: 'Spesifikasi berhasil ditambahkan!');
    }


    public function render()
    {
        // Ambil ID size_value yang sudah digunakan di varian ini
        $usedSizeIds = ProductVariantSpec::where('id_variant', $this->variant->id)
            ->pluck('id_size_value')
            ->toArray();

        return view('livewire.admin.spec.create', [
            'sizes' => SizeValue::where('id_size_group', $this->product->category->id_size_group)
                ->whereNotIn('id', $usedSizeIds)
                ->get(),
        ]);
    }
}
