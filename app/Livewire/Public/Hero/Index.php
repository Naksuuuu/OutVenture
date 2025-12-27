<?php

namespace App\Livewire\Public\Hero;

use App\Models\Brand;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {

        $brands = Brand::where('is_trusted', true)
            ->orderBy('is_trusted', 'desc')
            ->limit(4)
            ->get();


        return view('livewire.public.hero.index', [
            'brands' => $brands,
        ]);
    }
}
