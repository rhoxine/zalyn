<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $page_open = 'category';
   $page_title= 'category';
   $user= Auth::user();
        return view('admin.inventory.categories', compact('categories', 'page_open', 'user', 'page_title'));
    }
    
    public function create()
    {
        return view('admin.categories.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories',
            'category_desc' => 'required', // Set a default value here
        ]);
        $validatedData['category_desc'] = $validatedData['category_desc'] ?? null; // Set a default value if not provided
        
        Category::create($validatedData);
        
    
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }
    public function edit(Category $category)
    {
        $page_open = 'category';
        $page_title= 'category';
        $user= Auth::user();
        return view('admin/update_categories', compact('category', 'page_open', 'user', 'page_title'));
    }    
    
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|string|unique:categories,category_name,' . $category->id,
            'category_desc' => 'nullable|string',
        ]);
        
    
        $category->update([
            'category_name' => $request->input('category_name'),
            'category_desc' => $request->input('category_desc'),
        ]);
        
    
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }
    public function destroy(Category $category)
    {
        
        // Check if the category is associated with equipment
    $associatedEquipment = Products::where('category_id', $category->id)->first();

    if ($associatedEquipment) {
        return redirect()->back()->with('error', 'This category cannot be deleted because it has associated equipment.');
    }

    // If not associated, delete the category
    $category->delete();

    return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
         
}
