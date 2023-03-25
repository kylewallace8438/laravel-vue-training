<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

}
