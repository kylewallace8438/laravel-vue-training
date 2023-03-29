<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return view('admin.dashboard');
        } else{
            return view('admin.login');
        }
        
    }

    public function product()
    {
        return view('admin.product');
    }

    public function customer()
    {
        $customers = User::where('role_user',2)->get();
        // dd($customer);
        return view('admin.customer', compact('customers'));
    }

    public function admin_list()
    {
        $admins = User::where('role_user',1)->get();
        return view('admin.admin', compact('admins'));
    }

    public function order()
    {
        return view('admin.order');
    }

    public function add_product_show()
    {
        return view('admin.add_product');
    }

    public function add_product()
    {
        return view('admin.add_product');
    }

    public function edit_product()
    {
        return view('admin.edit_product');
    }

    public function edit_product_show()
    {
        return view('admin.edit_product');
    }

}
