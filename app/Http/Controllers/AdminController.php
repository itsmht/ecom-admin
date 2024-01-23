<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class AdminController extends Controller
{
    function dashboard()
    {
        return view('admin.dashboard');
    }
    function categories()
    {
        $categories = Category::all();
        return view('admin.categories')->with('categories', $categories);
    }
}
