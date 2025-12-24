<?php

namespace App\Livewire\Admin\Variant;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Component;


class Create extends Component
{

    public $product;
    public $id_color;
    public $isOpen;

    protected $rules = [
        'id_color' => 'required|exists:colors,id',
    ];


    public function mount(Product $product)
    {
        $this->product = $product;
        $this->isOpen = false;
    }





    public function save()
    {

        $this->validate();

        ProductVariant::create([
            'id_product' => $this->product->id,
            'id_color' => $this->id_color,
        ]);

        session()->flash('success', 'Varian berhasil ditambahkan!');

        $this->dispatch('variant-created'); // Emit event ke parent
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.admin.variant.create', [
            'colors' => Color::all(),
        ]);
    }
}
