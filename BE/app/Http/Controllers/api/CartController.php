<?php

namespace App\Http\Controllers\api;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //lấy danh sách tất cả giỏ hàng
    public function index()
    {
        $carts = Cart::all();
        return response()->json(['carts' => $carts], 200);
    }

    // Lấy thông tin của một giỏ hàng cụ thể
    public function show($id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        return response()->json(['cart' => $cart], 200);
    }

    // Tạo mới một giỏ hàng
    public function store(Request $request)
    {
        $cart = Cart::create($request->all());

        return response()->json(['cart' => $cart], 201);
    }

    // Cập nhật thông tin của một giỏ hàng
    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $cart->update($request->all());

        return response()->json(['cart' => $cart], 200);
    }

    // Xóa một giỏ hàng
    public function destroy($id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $cart->delete();

        return response()->json(['message' => 'Cart deleted successfully'], 204);
    }
}
