<?php

namespace App\Livewire\Public\Hero;

use App\Models\Brand;
use Livewire\Component;

class Show extends Component
{
    public $brand;

    public function mount($brandId)
    {
        $this->brand = Brand::findOrFail($brandId);
    }


    public function render()
    {



        return view('livewire.public.hero.show', [
            'brand' => $this->brand,
        ]);
    }
}
