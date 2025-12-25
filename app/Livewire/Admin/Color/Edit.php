<?php

namespace App\Livewire\Admin\Color;

use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.admin.color.edit')->layout('components.layouts.admin', ['title' => 'Edit Color']);
    }
}
