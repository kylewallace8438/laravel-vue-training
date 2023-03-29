<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Http\Controllers\Controller;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
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
        $orders = Order::all();
        return view('admin.order', compact('orders', $orders));
    }
    public function confirmOrder($id)
    {
        
        Order::where('id', $id)->update(['status' => 1]);
        $orders = Order::all();
        return view('admin.order', compact('orders', $orders));
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

    public function dashboard()
    {
        $product = Product::all()->count();
        $user = User::where('role_user',2)->get()->count();
        $order1 = Order::where('status',1)->get()->count();
        $order0 = Order::where('status',0)->get()->count();
        return view('admin.dashboard', compact('product', 'user', 'order0', 'order1'));
    }
}
