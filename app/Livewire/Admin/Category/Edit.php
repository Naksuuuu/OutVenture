<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;

class Edit extends Component
{
  public $category;
  public $nama_category;

  protected $rules = [
    'nama_category' => 'required|string|max:255'
  ];

  public function mount($categoryId)
  {
    $this->category = Category::findOrFail($categoryId);
    $this->nama_category = $this->category->nama_category;
  }

  public function update()
  {
    $this->validate();

    $this->category->update([
      'nama_category' => $this->nama_category
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
