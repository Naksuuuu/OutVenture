<?php

namespace App\Livewire\Admin\Size;

use App\Models\SizeGroup;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.size.index', ['sizes' => SizeGroup::all()])->layout('components.layouts.admin', ['title' => 'Size Management']);
    }
}
