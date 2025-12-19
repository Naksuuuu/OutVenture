<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with(['category', 'ProductVariant'])
            ->orderBy('id', 'desc')
            ->paginate(12);

        if (!$product) {
            return response()->json(['message' => 'Produk Tidak Ditemukan'], 404);
        }

        if (request()->has('category')) {
            $category = request()->query('category');
            $product->whereHas('category', function ($query) use ($category) {
                $query->where('name_category', $category);
            });
        }

        return response()->json($product);
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

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'ProductVariant']);

        if (!$product) {
            return response()->json(['message' => 'Product Tidak Ditemukan'], 404);
        }
        return response()->json($product);
    }


    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama_product' => 'sometimes|required|string|max:255',
            'brand' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'id_category' => 'sometimes|required|exists:categories,id',
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
