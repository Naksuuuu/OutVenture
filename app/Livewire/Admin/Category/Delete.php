<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Delete extends Component
{

    public $category;

    public function mount($category)
    {
        $this->category = Category::findOrFail($category);
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
