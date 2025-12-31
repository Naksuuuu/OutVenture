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

  protected $messages = [
    'nama_category.required' => 'Nama kategori wajib diisi.',
    'nama_category.max' => 'Nama kategori maksimal 255 karakter.',
    'id_size_group.required' => 'Kelompok ukuran wajib dipilih.',
    'id_size_group.exists' => 'Kelompok ukuran tidak valid.',
    'image.image' => 'File harus berupa gambar.',
    'image.max' => 'Ukuran gambar maksimal 2MB.',
  ];

  /**
   * Menyimpan kategori baru ke database.
   */
  public function save()
  {
    $this->validate();


    if ($this->image) {
      Category::create([
        'nama_category' => $this->nama_category,
        'id_size_group' => $this->id_size_group,
        'image' => $this->image->store('categories', 'public'),
      ]);
    } else {
      Category::create([
        'nama_category' => $this->nama_category,
        'id_size_group' => $this->id_size_group,
        'image' => null,
      ]);
    }


    return redirect()->route('admin.categories.index')->with('notifySuccess', 'Category Berhasil Dibuat!');
  }

  /**
   * Merender tampilan halaman pembuatan kategori.
   */
  public function render()
  {
    return view('livewire.admin.category.create', ['sizes' => SizeGroup::all()])
      ->layout('components.layouts.admin', ['title' => 'Create Category']);
  }
}
