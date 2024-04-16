<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $listUser = User::all();
        return view('pages.categories.index', compact('listUser'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.categories.edit', compact('user'));
    }
}
