<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Log;
use App\Models\Admin;
use App\Models\Account;
use File;
use Datetime;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminController;

class UserController extends Controller
{
    function users()
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        if($admin->admin_type=="1")
        {
            $users = Account::paginate(10);
        }
        else
        {
            $users =  DB::table('refers')
                    ->join('accounts', 'refers.account_id', '=', 'accounts.account_id')
                    ->select('accounts.account_id','accounts.account_name', 'accounts.account_phone', 'accounts.account_balance', 'accounts.account_status')
                    ->where('refers.admin_id', $admin->admin_id)
                    ->paginate(10);
        }
        
        return view('admin.users')->with('admin', $admin)->with('users',$users);
    }
    function userDetails(Request $req)
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $user = Account::where('account_id', $req->id)->first();
        return view('admin.userDetails')->with('admin', $admin)->with('user',$user);
    }
    function blockUser(Request $req)
    {
        $mytime = Carbon::now();
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $user = Account::where('account_id', $req->account_id)->first();
        //dd($user);
        if($user->account_status=="A")
        {
            $user->account_status = "L";
            $user->save();
            $log_string = "Blocked By: ".$admin->admin_name ." - Account ID: ".$user->account_id. " -  Name: ".$user->account_id." - Time: ".$mytime->toDateTimeString();
        }
        else
        {
            $user->account_status = "A";
            $user->save();
            $log_string = "Unblocked By: ".$admin->admin_name ." - Account ID: ".$user->account_id. " -  Name: ".$user->account_id." - Time: ".$mytime->toDateTimeString();
        }
        
        $log = new AdminController();
        $log->createLog("Account",$log_string);
        Alert::success('Successfull', 'Account Status Changed');
        return redirect()->route('users');
    }
    function updateUser(Request $req)
    {

    }
}
