<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Show extends Component
{

    public $category;



    public function mount($categoryId)
    {
        $this->category = Category::findOrFail($categoryId);
    }

    public function render()
    {
        return view('livewire.admin.category.show', ['category' => $this->category])->layout('components.layouts.admin', ['title' => 'Category Details']);
    }
}
