<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Sub_CategoryRequest;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;


class Sub_CategoryController extends Controller
{
    public function getSub_CategoryController($cate_id)
    {
        $product_list = Product::where('sub_category_id', $cate_id)->get();
        return response()->json($product_list);
    }

    public function index()
    {
        $subCategories = SubCategory::all();
        return response()->json(['subCategories' => $subCategories], 200);
    }

    public function show($id)
    {
        $subCategory = SubCategory::find($id);

        if (!$subCategory) {
            return response()->json(['error' => 'SubCategory not found'], 404);
        }

        return response()->json(['subCategory' => $subCategory], 200);
    }

    public function store(Sub_CategoryRequest $request)
    {


        $subCategory = SubCategory::create([
            'name' => $request->input('name'),
        ]);

        return response()->json(['subCategory' => $subCategory], 201);
    }

    public function update(Sub_CategoryRequest $request, $id)
    {
        $subCategory = SubCategory::find($id);

        if (!$subCategory) {
            return response()->json(['error' => 'SubCategory not found'], 404);
        }


        $subCategory->update([
            'name' => $request->input('name'),
        ]);

        return response()->json(['subCategory' => $subCategory], 200);
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);

        if (!$subCategory) {
            return response()->json(['error' => 'SubCategory not found'], 404);
        }

        $subCategory->delete();

        return response()->json(['message' => 'SubCategory deleted successfully'], 204);
    }
}
