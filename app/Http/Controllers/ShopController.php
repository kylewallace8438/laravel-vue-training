<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //
    public function show()
    {
        $products= Product::all();
        // dd($products);  
        return view('demo.shop', compact('products'));
    }
}
