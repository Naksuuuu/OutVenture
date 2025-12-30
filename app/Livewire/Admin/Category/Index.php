<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url; // Tambahkan ini
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
  use WithPagination;

  public $errorMessage = '';

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

  public function delete($id)
  {
    $this->errorMessage = '';
    $category = Category::find($id);


    if (!$category) {
      $this->errorMessage = 'Data tidak ditemukan.';
      return;
    }

    if ($category->products()->exists()) {
      $this->errorMessage = 'Kategori masih memiliki produk, hapus atau pindahkan produk terlebih dahulu.';
      return;
    }

    if ($category->image) {
      Storage::disk('public')->delete($category->image);
    }

    $category->delete();

    $this->dispatch('delete-success');
    $this->dispatch('notify', type: 'success', message: 'Kategori berhasil dihapus!');
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
