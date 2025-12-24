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
    $categories = Category::query()
      ->when($this->search, function ($query) {
        $query->where('nama_category', 'like', '%' . $this->search . '%');
      })
      ->withCount('products')
      ->latest() // Selalu urutkan agar user tidak bingung data baru di mana
      ->simplePaginate(10);

    return view('livewire.admin.category.index', [
      'categories' => $categories
    ])->layout('components.layouts.admin', ['title' => 'Categories Management']);
  }
}
