<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantSpec;
use Illuminate\Http\Request;

class ProductsVariantSpecController extends Controller
{
  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, Product $product, ProductVariant $variant)
  {
    if ($variant->id_product != $product->id) {
      return back()->withErrors(['variant' => 'Varian tidak sesuai dengan produk.']);
    }

    $validated = $request->validate([
      'id_size' => 'required|exists:Size,id',
      'sku' => 'required|string|max:100|unique:ProductVariantSpec,sku',
      'harga' => 'required|numeric|min:0',
      'stok' => 'required|integer|min:0',
    ]);

    $productVariantSpec = ProductVariantSpec::create([
      'id_variant' => $variant->id,
      'id_size' => $validated['id_size'],
      'sku' => $validated['sku'],
      'harga' => $validated['harga'],
      'stok' => $validated['stok'],
    ]);

    return back()->with('success', 'Spesifikasi varian produk berhasil ditambahkan.');
  }

  public function update(Request $request, Product $product, ProductVariant $variant, ProductVariantSpec $spec)
  {
    if ($variant->id_product != $product->id || $spec->id_variant != $variant->id) {
      return back()->withErrors(['spec' => 'Spesifikasi tidak sesuai dengan varian atau produk.']);
    }

    $validated = $request->validate([
      'id_size' => 'required|exists:Size,id',
      'sku' => 'required|string|max:100|unique:ProductVariantSpec,sku,' . $spec->id,
      'harga' => 'required|numeric|min:0',
      'stok' => 'required|integer|min:0',
    ]);

    $spec->update($validated);

    return back()->with('success', 'Spesifikasi varian produk berhasil diperbarui.');
  }

  public function destroy(Product $product, ProductVariant $variant, ProductVariantSpec $spec)
  {
    if ($variant->id_product != $product->id || $spec->id_variant != $variant->id) {
      return back()->withErrors(['spec' => 'Spesifikasi tidak sesuai dengan varian atau produk.']);
    }

    $spec->delete();

    return redirect()->route('admin.products.edit', $product)->with('success', 'Spesifikasi varian produk berhasil dihapus.');
  }
}
