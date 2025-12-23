<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;

class Create extends Component
{
  public $nama_category = '';

  protected $rules = [
    'nama_category' => 'required|string|max:255'
  ];

  public function save()
  {
    $this->validate();

    Category::create([
      'nama_category' => $this->nama_category,
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
