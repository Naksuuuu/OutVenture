<?php

namespace App\Livewire\Admin\Variant;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{

    use WithFileUploads;

    public $product;
    public $id_color;
    public $isOpen;
    public $image;

    protected $rules = [
        'id_color' => 'required|exists:colors,id',
        'image' => 'nullable|image|max:2048',
    ];

    protected $listeners = ['variant-deleted' => 'refreshAvailableColors'];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->isOpen = false;
    }

    public function save()
    {

        $this->validate();

        $imagePath = $this->image ? $this->image->store('variants', 'public') : null;

        ProductVariant::create([
            'id_product' => $this->product->id,
            'id_color' => $this->id_color,
            'image' => $imagePath,
        ]);

        $this->reset(['id_color', 'image']);
        $this->dispatch('variant-created');
        $this->dispatch('variant-deleted');
        $this->dispatch('show-success-message', message: 'Tambah varian warna berhasil')->to('admin.product.edit');
        $this->isOpen = false;
    }

    public function refreshAvailableColors()
    {
        // Refresh product data dari database
        $this->product = Product::with(['variants.color'])->findOrFail($this->product->id);
    }

    public function render()
    {
        $usedColorIds = $this->product->variants->pluck('id_color')->toArray();

        $availableColors = Color::whereNotIn('id', $usedColorIds)->get();

        return view('livewire.admin.variant.create', [
            'colors' => $availableColors,
        ]);
    }
}
