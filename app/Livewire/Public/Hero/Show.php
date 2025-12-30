<?php

namespace App\Livewire\Public\Hero;

use App\Models\Brand;
use Livewire\Component;

class Show extends Component
{
    public $brand;

    public function mount($brand)
    {
        // Accept either Brand model instance or brand ID/slug
        if ($brand instanceof Brand) {
            $this->brand = $brand;
        } else {
            $this->brand = Brand::where('slug', $brand)->orWhere('id', $brand)->firstOrFail();
        }
    }


    public function render()
    {



        return view('livewire.public.hero.show', [
            'brand' => $this->brand,
        ]);
    }
}
