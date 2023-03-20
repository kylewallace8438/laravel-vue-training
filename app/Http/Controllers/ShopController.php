<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function show(){

        $products = Product::all();
        // dd($products);
        return view('demo.shop',compact('products'));
    }

}
