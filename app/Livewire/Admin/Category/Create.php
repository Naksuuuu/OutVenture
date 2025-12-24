<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use App\Models\SizeGroup;
use Livewire\WithFileUploads;

class Create extends Component
{

  use WithFileUploads;

  public $nama_category = '';
  public $image;
  public $id_size_group;

  protected $rules = [
    'nama_category' => 'required|string|max:255',
    'id_size_group' => 'required|exists:size_groups,id',
    'image' => 'nullable|image|max:2048',
  ];

  public function save()
  {
    $this->validate();

    Category::create([
      'nama_category' => $this->nama_category,
      'id_size_group' => $this->id_size_group,
      'image' => $this->image->store('categories', 'public'),
    ]);

    session()->flash('success', 'Category created successfully!');

    return redirect()->route('admin.categories.index');
  }

  public function render()
  {
    return view('livewire.admin.category.create', ['sizes' => SizeGroup::all()])
      ->layout('components.layouts.admin', ['title' => 'Create Category']);
  }
}
