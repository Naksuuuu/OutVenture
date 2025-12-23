<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;

class Create extends Component
{
  public $name_category = '';
  public $description = '';

  protected $rules = [
    'name_category' => 'required|string|max:255',
    'description' => 'nullable|string',
  ];

  public function save()
  {
    $this->validate();

    Category::create([
      'name_category' => $this->name_category,
      'description' => $this->description,
    ]);

    session()->flash('success', 'Category created successfully!');

    return redirect()->route('admin.categories.index');
  }

  public function render()
  {
    return view('livewire.admin.category.create')
      ->layout('components.layouts.admin', ['title' => 'Create Category']);
  }
}
