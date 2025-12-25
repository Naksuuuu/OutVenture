<?php

namespace App\Livewire\Public\Brand;

use Livewire\Component;
use App\Models\Brand;

class Index extends Component
{
    public function render()
    {
        $trustedBrands = Brand::where('is_trusted', true)
            ->with(['products' => function ($query) {
                $query->with(['category', 'variants']);
            }])
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('livewire.public.brand.index', [
            'trustedBrands' => $trustedBrands
        ])->layout('components.layouts.app', ['title' => 'Brands']);
    }
}
