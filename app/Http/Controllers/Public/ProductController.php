<?php

namespace App\Http\Controllers\Public;

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
        $query = Product::with(['category', 'variants', 'brand']);

        if (request()->has('category')) {
            $category = request()->query('category');
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name_category', $category);
            });
        }

        $products = $query->orderBy('id', 'desc')->paginate(12);

        return view('public.products.index', ['products' => $products]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'variants', 'brand']);

        return view('public.products.show', compact('product'));
    }
}
