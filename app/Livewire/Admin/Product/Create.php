<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class Create extends Component
{
  public $nama_product = '';
  public $brand = '';
  public $deskripsi = '';
  public $id_category = '';

  protected $rules = [
    'nama_product' => 'required|string|max:255',
    'brand' => 'required|string|max:255',
    'deskripsi' => 'nullable|string',
    'id_category' => 'required|exists:categories,id',
  ];

  public function save()
  {
    $this->validate();

    Product::create([
      'nama_product' => $this->nama_product,
      'brand' => $this->brand,
      'deskripsi' => $this->deskripsi,
      'id_category' => $this->id_category,
    ]);

    session()->flash('success', 'Product created successfully!');

    return redirect()->route('admin.products.index');
  }

  public function render()
  {
    $categories = Category::all();

    return view('livewire.admin.product.create', [
      'categories' => $categories
    ])->layout('components.layouts.admin', ['title' => 'Create Product']);
  }
}
