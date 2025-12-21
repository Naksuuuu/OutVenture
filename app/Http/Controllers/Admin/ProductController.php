<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Product::with(['category', 'variants', 'brand'])->orderBy('id', 'desc');

        if (request()->has('category')) {
            $category = request()->query('category');
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('nama_category', $category);
            });
        }

        if (request()->has('search')) {
            $search = request()->query('search');
            $query->where('nama_product', 'like', '%' . $search . '%');
        }

        $products = $query->paginate(12);

        return view('admin.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_product' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'id_category' => 'required|exists:categories,id',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function edit(Product $product)
    {
        $product->load(['category', 'brand', 'variants.specs', 'variants.color']);

        $categories = \App\Models\Category::all();
        $brands = \App\Models\Brand::all();
        $colors = \App\Models\Color::all();
        $sizes = Size::where('id_category', $product->id_category)->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'colors', 'sizes'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'variants', 'brand']);

        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama_product' => 'required|string|max:255',
            'id_brand'     => 'required',
            'id_category'  => 'required',
            'deskripsi'    => 'nullable|string',
        ]);

        if ($request->has('colors')) {
            foreach ($request->colors as $variantId => $colorId) {
                \App\Models\ProductVariant::where('id', $variantId)->update(['id_color' => $colorId]);
            }
        }

        if ($request->has('prices')) {
            foreach ($request->prices as $specId => $hargaBaru) {
                \App\Models\ProductVariantSpec::where('id', $specId)->update([
                    'sku'   => $request->skus_spec[$specId], // Sesuaikan name di blade nanti
                    'harga' => $hargaBaru,
                    'stok'  => $request->stocks[$specId]
                ]);
            }
        }

        $product->update($validated);
        return redirect()->route('admin.products.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
