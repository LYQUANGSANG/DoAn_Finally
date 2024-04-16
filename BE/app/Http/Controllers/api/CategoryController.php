<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $categories = Category::with('subCategories')->get();

        return response()->json($categories);
    }

    public function getCategoryProduct($cate_id)
    {
        // $category = Category::where('id', $cate_id)->first();
        // $products_list = $category->product();

        $products_list = Product::where('category_id', $cate_id)->get();

        return response()->json($products_list);
    }

    // Thêm 
    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description ?? null
        ]);

        // $cate = new Category();
        // $cate->name = $request->name;
        // $cate->save();

        return response()->json(['message' => 'Category created successfully', 'data' => $category]);
    }
    // 
    public function update(UpdateCategoryRequest $request)
    {
        // Find the category by ID
        $category = Category::find($request->id);

        // Check if the category exists
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $category->name = $request->name;
        $category->type = $request->type;
        $category->description = $request->description ?? null;
        $category->save();
        return response()->json(['message' => 'Category update successfully', 'data' => $category]);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Category delete successfully']);
    }
}
