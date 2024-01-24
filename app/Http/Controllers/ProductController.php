<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Admin;
use File;
use Datetime;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    function products()
    {
        $products = Product::all();
        
        return view('admin.products')->with('products', $products);
    }
    function addProduct()
    {
        $categories = Category::all();
        return view('admin.addProduct')->with('categories', $categories);
    }
    function addProductRequest(Request $req)
    {

    }
}
