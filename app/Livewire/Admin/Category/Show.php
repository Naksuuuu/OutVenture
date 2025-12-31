<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Show extends Component
{

    public $category;



    /**
     * Menyiapkan data detail kategori.
     */
    public function mount(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Merender tampilan detail kategori.
     */
    public function render()
    {
        return view('livewire.admin.category.show', ['category' => $this->category])->layout('components.layouts.admin', ['title' => 'Category Details']);
    }
}
