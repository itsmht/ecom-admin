<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Admin;
use File;
use Datetime;
use Carbon\Carbon;
use App\Http\Controllers\AdminController;
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
        $image_count = 1;
        $req->validate(
            [
                'product_name'=> 'required',
                'category_id'=> 'required',
                'product_actual_price'=> 'required',
                'product_min_buy_quantity'=> 'required',
                'product_stock'=> 'required',
                'product_images.*' => 'mimes:jpg,jpeg,png',
    
    
            ], 
            [
                'product_name.required' =>'Product Name Is Required',
                'category_id.required' =>'Category Is Required',
                'product_actual_price.required' =>'Price Is Required',
                'product_min_buy_quantity.required' =>'Minimum Buy Quantity Is Required',
                'product_stock.required' =>'Product Stock Is Required',
                'product_images.mimes' =>'Format is not allowed to upload',
                
            ]);
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $mytime = Carbon::now();
        $product = new Product();
        $product->product_name = $req->product_name;
        $product->category_id = $req->category_id;
        $price_in_coin = $req->product_actual_price/100;
        $product->product_actual_price = $price_in_coin;
        if($req->product_discount_percentage)
        {
            $discounted_price = ceil($price_in_coin - (($req->product_discount_percentage/100)*$price_in_coin));
            $product->product_discounted_price = $discounted_price;
            $product->product_discount_percentage = $req->product_discount_percentage;
        }
        else
        {   $product->product_discounted_price = $price_in_coin;
            $product->product_discount_percentage = 0;
        }
        $product->product_brand = $req->product_brand;
        $product->product_shop = $req->product_shop;
        $product->product_min_buy_quantity = $req->product_min_buy_quantity;
        $product->product_stock = $req->product_stock;
        $product->product_status = "1";
        $product->product_description = $req->product_description;
        $product->product_slug = $req->product_name."-".$mytime->toDateString();
        $product->save();
        if ($req->hasFile('product_images')) 
        {
            foreach ($req->file('product_images') as $file) 
            {
                //$filename = time() . '_' . $file->getClientOriginalName();
                //$file->storeAs('your_upload_directory', $filename, 'public');
                // You can save the file path or perform other operations here
                
                $url = "https://admin.quirkybuy.com/public/product_images";
                //$file_name = $url."/".$product->product_name."-".$admin->admin_phone."-".time().".".$req->file('product_image')->getClientOriginalExtension();
                //$req->file('product_image')->move(public_path('product_images'),$file_name);
                $file_name = $url . "/" . $product->product_name . "-" . $admin->admin_phone . "-" . time() . $image_count ."." . $file->getClientOriginalExtension();
                $file->move(public_path('product_images'), $file_name);
                $productImage = new ProductImage();
                $productImage->product_image_value = $file_name;
                $productImage->product_image_status = "1";
                $productImage->product_id = $product->product_id;
                $productImage->save();
                $image_count++;

            }
        }
        $log_string = "Created By: ".$admin->admin_name ." - Product ID: ".$product->product_id. " - Product Name: ".$product->product_name." - Time: ".$mytime->toDateTimeString();
        $log = new AdminController();
        $log->createLog("Product",$log_string);
        Alert::success('Successfull', 'New Product Added');
        return redirect()->route('products');
    }
}
