<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
public function index(Request $request)
{
    $query = Category::query();

    
    if ($request->has('search') && $request->search != '') {
        $query->where('name_category', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
    }

    
    $categories = $query->withCount('products')->get(); 
    
    return view('admin.categories.index', compact('categories'));
}

    
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name_category' => 'required|string|max:255',
            'description'   => 'nullable|string', 
        ]);

        Category::create([
            'name_category' => $request->name_category,
            'description'   => $request->description,
        ]);

        
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) 
    {
        $request->validate([
            'name_category' => 'required|string|max:255',
            'description'   => 'nullable|string',
        ]);

        $category->update([
            'name_category' => $request->name_category,
            'description'   => $request->description,
        ]);

        
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}