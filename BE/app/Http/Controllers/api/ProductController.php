<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Models\Product_Detail;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductDetailByProductId($product_id)
    {
        $product = Product::with('Product_Detail')->where('id', $product_id)->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product_detail = $product->product_detail;

        return response()->json($product_detail);
    }

    // Lấy danh sách tất cả sản phẩm
    public function index()
    {
        $products = Product::all();
        foreach ($products as $prod) {
            if (!empty($prod->image)) {
                $prod->img_url = asset($prod->image);
            } else {
                $prod->img_url = '';
            }
        }
        return response()->json(['products' => $products], 200);
    }

    // Hiển thị thông tin chi tiết của một sản phẩm
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json(['product' => $product], 200);
    }

    // Tạo mới một sản phẩm
    public function store(CreateProductRequest $request)
    {
        // Lấy tên của tệp ảnh
        $imageName = time() . '.' . $request->image->extension();

        // Di chuyển tệp ảnh vào thư mục public/images
        $request->image->move(public_path('images'), $imageName);


        $product = new Product();
        $product->name = $request->name ?? '';
        $product->memo = $request->memo ?? '';
        $product->category_id = $request->category_id ?? '';
        $product->sub_category_id = $request->sub_category_id ?? '';
        $product->status = $request->status ?? 1;
        $product->price = $request->price ?? 0;
        $product->isnew = $request->isnew ?? 1;
        $product->views = $request->views ?? 0;
        $product->quantity_sold = $request->quantity_sold ?? 0;
        $product->image = 'images/' . $imageName ?? '';
        $product->save();

        return response()->json(['product' => $product], 201);
    }

    // Cập nhật thông tin của một sản phẩm
    public function update(CreateProductRequest $request, $id)
    {
        if (empty($id)) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        if (!empty($request->image)) {
            // Lấy tên của tệp ảnh
            $imageName = time() . '.' . $request->image->extension();
            // Di chuyển tệp ảnh vào thư mục public/images
            $request->image->move(public_path('images'), $imageName);
        }

        $product->name = $request->name ?? '';
        $product->memo = $request->memo ?? '';
        $product->category_id = $request->category_id ?? '';
        $product->sub_category_id = $request->sub_category_id ?? '';
        $product->status = $request->status ?? 1;
        $product->price = $request->price ?? 0;
        $product->isnew = $request->isnew ?? 1;
        $product->views = $request->views ?? 0;
        $product->quantity_sold = $request->quantity_sold ?? 0;
        $product->image = 'images/' . $imageName ?? '';
        $product->save();

        return response()->json(['product' => $product], 200);
    }

    // Xóa một sản phẩm
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 204);
    }

    //upload ảnh của sản phẩm

}
