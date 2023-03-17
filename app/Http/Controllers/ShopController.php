<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function show(){
        $products = DB::select('select * from products');
        // dd($products);
        return view('demo.shop',compact('products'));
    }

}
