<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $listUser = User::all();
        return view('pages.products.index', compact('listUser'));
    }

    public function create()
    {
        return view('pages.products.create');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.products.edit', compact('user'));
    }
}
