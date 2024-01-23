<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Admin;
use File;
use Datetime;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

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
    function addCategory(Request $req)
    {
        $req->validate(
        [
            'category_name'=> 'required',
            'category_logo' => 'mimes:jpg,jpeg,png',
            'category_banner'=>'mimes:jpg,jpeg,png',


        ], 
        [
            'category_name.required' =>'Category Name Is Required',
            'category_logo.mimes' =>'Format is not allowed to upload',
            'category_banner.mimes'=>'Format is not allowed to upload',
            
        ]);
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $category = new Category();
        $category->category_name = $req->category_name;
        $mytime = Carbon::now();
 

        if($req->category_logo)
        {
            //$url = "https://quirkybuy.com/app_images";
            //$folderPath = "category_images"."/".$mytime->toDateString()."-".$admin->admin_name;
            //$name = $admin->admin_phone. "-" . time() . '.' . $req->file('category_logo')->getClientOriginalExtension();
            //$req->file('category_logo')->storeAs($folderPath, $name, 'public_outside');
            //$category->category_logo =$url . "/" . $folderPath. "/"  . $name;
            $url = "https://admin.quirkybuy.com/public/category_images";
            $file_name = $url."/".$admin->admin_phone.time().".".$req->file('category_logo')->getClientOriginalExtension();
            $req->file('category_logo')->move(public_path('category_images'),$file_name);
            $category->category_logo = $file_name;
        }
        if($req->category_banner)
        {
            //$url = "https://quirkybuy.com/app_images";
            //$folderPath = "category_images"."/".$mytime->toDateString()."-".$admin->admin_name;
            //$name = $admin->admin_phone. "-" . time() . '.' . $req->file('category_logo')->getClientOriginalExtension();
            //$req->file('category_banner')->storeAs($folderPath, $name, 'public_outside');
            //$category->category_banner =$url . "/" . $folderPath. "/"  . $name;
            $url = "https://admin.quirkybuy.com/public/category_images";
            $file_name = $url."/".$admin->admin_phone.time()."."."banner".$req->file('category_banner')->getClientOriginalExtension();
            $req->file('category_banner')->move(public_path('category_images'),$file_name);
            $category->category_banner = $file_name;
        }
        $category->category_status = "Active";
        $category->save();
        Alert::success('Successfull', 'New Category Added');
        return back();
    }
}
