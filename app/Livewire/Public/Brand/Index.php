<?php

namespace App\Livewire\Public\Brand;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.public.brand.index')->layout('components.layouts.app', ['title' => 'Brands']);
    }
}
