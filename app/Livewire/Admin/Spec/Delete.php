<?php

namespace App\Livewire\Admin\Spec;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantSpec;
use App\Models\Size;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Delete extends Component
{

    public $spec;
    public $variant;
    public $isOpen;



    public function mount(ProductVariantSpec $spec, ProductVariant $variant)
    {
        $this->isOpen = false;
        $this->spec = $spec;
        $this->variant = $variant;
    }

    public function save()
    {


        ProductVariantSpec::where('id', $this->spec->id)->delete();

        $this->dispatch('spec-events');
        $this->isOpen = false;

        session()->flash('success', 'Spesifikasi berhasil dihapus!');
    }


    public function render()
    {
        return view('livewire.admin.spec.delete');
    }
}
