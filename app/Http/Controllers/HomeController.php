<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('demo.index');
    }

    public function shop()
    {
        return view('demo.shop');
    }

    public function about()
    {
        return view('demo.about');
    }
    public function service()
    {
        return view('demo.service');
    }
    public function blog()
    {
        return view('demo.blog');
    }
    public function contact()
    {
        return view('demo.contact');
    }

    public function customer()
    {
        return view('demo.customer');
    }

    public function cart()
    {
        return view('demo.cart');
    }
}
