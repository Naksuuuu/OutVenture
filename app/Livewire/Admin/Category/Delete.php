<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;

class Delete extends Component
{

    public $category;
    public $nama_category;
    public $categoryId;
    
    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->category = \App\Models\Category::findOrFail($categoryId);
        $this->nama_category = $this->category->nama_category;
    }
    public function delete()
    {
        $this->category->delete();

        session()->flash('success', 'Category deleted successfully!');

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.category.delete');
    }
}
