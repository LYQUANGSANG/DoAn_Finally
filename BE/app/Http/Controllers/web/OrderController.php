<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $listUser = User::all();
        return view('pages.orders.index', compact('listUser'));
    }

    public function create()
    {
        return view('pages.orders.create');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.orders.edit', compact('user'));
    }
}
