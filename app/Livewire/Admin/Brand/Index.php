<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;

class Index extends Component
{




    public function render()
    {
        return view('livewire.admin.brand.index', ['brands' => Brand::all()])->layout('components.layouts.admin', ['title' => 'Brand']);
    }
}
