<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }
    /**
     * Display a listing of the resource.Based on pagination
     */
    public function pagination()
    {
        $categories = Category::paginate(1); // Adjust the number per page as needed
        return response()->json(['categories' => $categories]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // create category
        $validateData = $request->validate([
            'categoryname' => 'required|unique:categories|max:255',
            ]);
            
            $category = new Category;
            $category->categoryname = $request->categoryname;
            $category->save();
            return response()->json([
                'status' => true,
                'message' => 'category created Successfully',
            ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Retrieve the category using Eloquent
        $category = Category::find($category->id);
        // Check if the category exists
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        // Return a JSON response with the category
        return response()->json(['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update([
            'categoryname' => $request->categoryname,
        ]);
        // Optionally, you can fetch the updated category after the update
        $updatedCategory = Category::find($category->id);
        // Return a JSON response with the updated category
        return response()->json(['message' => 'Category updated successfully', 'category' => $updatedCategory]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
    if (!$category) {
        return response()->json(['message' => 'Category not found'], 404);
    }
    $category->delete();
    return response()->json(['message' => 'Category deleted successfully']);
    }
}
