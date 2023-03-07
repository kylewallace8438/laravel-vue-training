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
    
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
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
    public function services()
    {
        return view('demo.services');
    }
}
