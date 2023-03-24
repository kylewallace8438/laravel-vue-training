<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.order');
    }

}
