<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;

class Edit extends Component
{
  public $category;
  public $name_category;
  public $description;

  protected $rules = [
    'name_category' => 'required|string|max:255',
    'description' => 'nullable|string',
  ];

  public function mount($categoryId)
  {
    $this->category = Category::findOrFail($categoryId);
    $this->name_category = $this->category->name_category;
    $this->description = $this->category->description;
  }

  public function update()
  {
    $this->validate();

    $this->category->update([
      'name_category' => $this->name_category,
      'description' => $this->description,
    ]);

    session()->flash('success', 'Category updated successfully!');

    return redirect()->route('admin.categories.index');
  }

  public function render()
  {
    return view('livewire.admin.category.edit')
      ->layout('components.layouts.admin', ['title' => 'Edit Category']);
  }
}
