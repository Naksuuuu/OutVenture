<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        // return response()->json($categories);
        return view('admin.categories.index', compact('categories'));
    }


    public function store(Request $request) {
        $request->validate([
            'name_category' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'name_category' => $request->name_category
        ]);

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category) {
        return response()->json($category);
    }


    public function update(Request $request, Category $category) {
        $request->validate([
            'name_category' => 'required|string|max:255',
        ]);

        $category->update([
            'name_category' => $request->name_category
        ]);

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
