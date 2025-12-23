<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class Index extends Component
{
  use WithPagination;

  public $search = '';

  protected $queryString = ['search'];

  public function updatingSearch()
  {
    $this->resetPage();
  }

  public function deleteCategory($categoryId)
  {
    $category = Category::find($categoryId);
    if ($category) {
      $category->delete();
      session()->flash('success', 'Category deleted successfully!');
    }
  }

  public function render()
  {
    $query = Category::query();

    if ($this->search) {
      $query->where('name_category', 'like', '%' . $this->search . '%')
        ->orWhere('description', 'like', '%' . $this->search . '%');
    }

    $categories = $query->withCount('products')->paginate(10);

    return view('livewire.admin.category.index', [
      'categories' => $categories
    ])->layout('components.layouts.admin', ['title' => 'Categories Management']);
  }
}
