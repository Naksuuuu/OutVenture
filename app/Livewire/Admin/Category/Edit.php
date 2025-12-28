<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use App\Models\SizeGroup;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{

  use WithFileUploads;

  public $category;
  public $nama_category;
  public $id_size_group;
  public $oldImage;
  public $new_image;

  protected $rules = [
    'nama_category' => 'required|string|max:255',
    'id_size_group' => 'required|exists:size_groups,id',
    'new_image' => 'nullable|image|max:2048',

  ];

  public function mount($categoryId)
  {
    $this->category = Category::findOrFail($categoryId);
    $this->nama_category = $this->category->nama_category;
    $this->id_size_group = $this->category->id_size_group;
    $this->oldImage = $this->category->image;
  }

  public function update()
  {
    $this->validate();

    $imagePath = $this->oldImage;
    if ($this->new_image) {
      $newPath = $this->new_image->store('categories', 'public');
      $imagePath = $newPath;
      
      if ($this->oldImage && $this->oldImage !== $newPath) {
        $this->deletePublicFile($this->oldImage);
      }
    }

    $this->category->update([
      'nama_category' => $this->nama_category,
      'id_size_group' => $this->id_size_group,
      'image' => $imagePath,
    ]);

    return redirect()->route('admin.categories.index')->with('notifySuccess', 'Category Berhasil Diperbarui!');
  }

  protected function deletePublicFile(?string $path): void
  {
    if (!$path) return;
    try {
      if (Storage::disk('public')->exists($path)) {
        Storage::disk('public')->delete($path);
      }
    } catch (\Exception $e) {
      $full = public_path('storage/' . ltrim($path, '/'));
      if (is_file($full)) {
        @unlink($full);
      }
    }
  }

  public function render()
  {
    return view('livewire.admin.category.edit', ['sizes' => SizeGroup::all()])
      ->layout('components.layouts.admin', ['title' => 'Edit Category']);
  }
}