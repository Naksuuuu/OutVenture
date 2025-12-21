<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVarianController extends Controller
{
  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, Product $product)
  {
    $validated = $request->validate([
      'id_color' => 'required|exists:Color,id',
    ]);

    ProductVariant::create([
      'id_product' => $product->id,
      'id_color' => $validated['id_color'],
    ]);

    return redirect()->route('admin.products.edit', $product)->with('success', 'Varian produk berhasil ditambahkan.');
  }

  public function update(Request $request, Product $product, ProductVariant $variant)
  {
    if ($variant->id_product != $product->id) {
      return back()->withErrors(['variant' => 'Varian tidak sesuai dengan produk.']);
    }

    $validated = $request->validate([
      'id_color' => 'required|exists:Color,id',
    ]);

    $variant->update([
      'id_color' => $validated['id_color'],
    ]);

    return back()->with('success', 'Varian produk berhasil diperbarui.');
  }

  public function destroy(Product $product, ProductVariant $variant)
  {
    if ($variant->id_product != $product->id) {
      return back()->withErrors(['variant' => 'Varian tidak sesuai dengan produk.']);
    }

    $variant->delete();

    return back()->with('success', 'Varian produk berhasil dihapus.');
  }
}
