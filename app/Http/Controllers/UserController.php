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
        return view('admin.userDetails');
    }
    function blockUser(Request $req)
    {

    }
    function updateUser(Request $req)
    {

    }
}
