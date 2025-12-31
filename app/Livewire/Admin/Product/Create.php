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

  protected $messages = [
    'nama_product.required' => 'Nama produk wajib diisi.',
    'nama_product.max' => 'Nama produk maksimal 255 karakter.',
    'id_brand.required' => 'Brand wajib dipilih.',
    'id_brand.exists' => 'Brand yang dipilih tidak valid.',
    'id_category.required' => 'Kategori wajib dipilih.',
    'id_category.exists' => 'Kategori yang dipilih tidak valid.',
  ];

  private $categoryKeywords = [
    // Tenda keywords
    'Tenda' => 'Tenda',
    'tenda' => 'Tenda',

    // Sleeping Bag keywords
    'Sleeping Bag' => 'Sleeping Bag',
    'sleeping bag' => 'Sleeping Bag',
    'Sleepingbag' => 'Sleeping Bag',
    'sleepingbag' => 'Sleeping Bag',

    // Sepatu keywords
    'Sepatu' => 'Sepatu',
    'sepatu' => 'Sepatu',

    // Matras keywords
    'Matras' => 'Matras',
    'matras' => 'Matras',

    // Tas keywords
    'Tas' => 'Tas',
    'tas' => 'Tas',
    'Ransel' => 'Tas',
    'ransel' => 'Tas',

    // Pakaian keywords
    'Parka' => 'Pakaian',
    'parka' => 'Pakaian',
    'Jaket' => 'Pakaian',
    'jaket' => 'Pakaian',
    'Jacket' => 'Pakaian',
    'Pakaian' => 'Pakaian',
    'pakaian' => 'Pakaian',

    // Topi keywords
    'Topi' => 'Topi',
    'topi' => 'Topi',
    'Kupluk' => 'Topi',
    'kupluk' => 'Topi',

    // Kompor keywords
    'Kompor' => 'Kompor',
    'kompor' => 'Kompor',

    // Furniture keywords
    'Furniture' => 'Furniture',
    'furniture' => 'Furniture',
    'Meja' => 'Furniture',
    'meja' => 'Furniture',
    'Kursi' => 'Furniture',
    'kursi' => 'Furniture',
    'Kursi Lipat' => 'Furniture',
    'Kursi lipat' => 'Furniture',
    'kursi lipat' => 'Furniture',
  ];

  /**
   * Mendeteksi kategori secara otomatis berdasarkan kata kunci dalam nama produk.
   */
  public function updatedNamaProduct()
  {
    $namaLower = strtolower(trim($this->nama_product));

    if (empty($namaLower)) {
      return;
    }

    foreach ($this->categoryKeywords as $keyword => $categoryName) {
      if (strpos($namaLower, strtolower($keyword)) !== false) {
        $category = Category::whereRaw('LOWER(nama_category) LIKE ?', ['%' . strtolower($categoryName) . '%'])->first();
        if ($category) {
          $this->id_category = $category->id;
          break;
        }
      }
    }
  }

  /**
   * Menyimpan produk baru ke database.
   */
  public function saveProduct()
  {
    $this->validate();

    Product::create([
      'nama_product' => $this->nama_product,
      'id_brand' => $this->id_brand,
      'deskripsi' => $this->deskripsi,
      'id_category' => $this->id_category,
    ]);

    return redirect()->route('admin.products.index')->with('notifySuccess', 'Product Berhasil Dibuat!');
  }

  /**
   * Merender tampilan halaman pembuatan produk.
   */
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
