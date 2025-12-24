<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class Create extends Component
{
  public $nama_product = '';
  public $id_brand = '';
  public $deskripsi = '';
  public $id_category = '';

  protected $rules = [
    'nama_product' => 'required|string|max:255',
    'id_brand' => 'required|exists:brands,id',
    'deskripsi' => 'nullable|string',
    'id_category' => 'required|exists:categories,id',
  ];

  public function saveProduct()
  {


    $this->validate();

    Product::create([
      'nama_product' => $this->nama_product,
      'id_brand' => $this->id_brand,
      'deskripsi' => $this->deskripsi,
      'id_category' => $this->id_category,
    ]);

    session()->flash('success', 'Product created successfully!');

    return redirect()->route('admin.products.index');
  }

  public function render()
  {
    $categories = Category::all();
    $brands = Brand::all();

    return view('livewire.admin.product.create', [
      'categories' => $categories,
      'brands' => $brands,
    ])->layout('components.layouts.admin', ['title' => 'Create Product']);
  }
}
