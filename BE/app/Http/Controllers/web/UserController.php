<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $listUser = User::all();
        return view('pages.users.index', compact('listUser'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.users.edit', compact('user'));
    }
}
