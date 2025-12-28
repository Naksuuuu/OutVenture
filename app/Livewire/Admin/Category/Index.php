<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url; // Tambahkan ini
use App\Models\Category;

class Index extends Component
{
  use WithPagination;

  #[Url(history: true, keep: true)]
  public $search = '';

  #[Url(history: true, keep: true)]
  public $sortBy = 'latest';

  public function updatingSearch()
  {
    $this->resetPage();
  }

  public function updatingSortBy()
  {
    $this->resetPage();
  }

  public function deleteCategory($categoryId)
  {
    $category = Category::find($categoryId);
    if ($category) {
      $category->delete();
      $this->dispatch('notify', type: 'success', message: 'Category deleted successfully!');
    }
  }

  public function render()
  {
    $categories = Category::query()
      ->when($this->search, function ($query) {
        $query->where('nama_category', 'like', '%' . $this->search . '%');
      })
      ->withCount('products')
      ->when($this->sortBy === 'latest', function ($query) {
        $query->latest();
      })
      ->when($this->sortBy === 'oldest', function ($query) {
        $query->oldest();
      })
      ->simplePaginate(10);

    return view('livewire.admin.category.index', [
      'categories' => $categories
    ])->layout('components.layouts.admin', ['title' => 'Categories Management']);
  }
}
