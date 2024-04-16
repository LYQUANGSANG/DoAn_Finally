<?php

namespace App\Http\Controllers\api;

use App\Models\Image_Product;
use Illuminate\Http\Request;

class Image_ProductController extends Controller
{
    public function upload(Request $request)
    {
        // Kiểm tra và xác thực dữ liệu đầu vào
        $request->validate([
            'product_id' => "required",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Lấy tên của tệp ảnh
        $imageName = time() . '.' . $request->image->extension();

        // Di chuyển tệp ảnh vào thư mục public/images
        $request->image->move(public_path('images'), $imageName);

        // Tạo mới bản ghi trong bảng images với tên tệp ảnh
        $image = Image_Product::create([
            'image' => $imageName,
            'product_id' => $request->product_id,
            'is_title' => $request->is_title ?? false
        ]);

        // Trả về JSON response với thông báo và dữ liệu tệp ảnh
        return response()->json(['message' => 'Image uploaded successfully', 'image' => $image]);
    }
}
