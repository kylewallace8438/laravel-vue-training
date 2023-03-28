<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function product()
    {
        return view('admin.product');
    }

    public function customer()
    {
        return view('admin.customer');
    }

    public function admin_list()
    {
        return view('admin.admin');
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

    public function dashboard()
    {
        $product = Product::all()->count();
        $user = User::where('role_user',2)->get()->count();
        $order1 = Order::where('status',1)->get()->count();
        $order0 = Order::where('status',0)->get()->count();
        return view('admin.dashboard', compact('product', 'user', 'order0', 'order1'));
    }
}
