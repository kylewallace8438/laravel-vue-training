<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function add_product(Request $request)
    {
        $name = $request->get('name');
        // dd($name);
        $price = $request->get('price');
        // dd($price);

        Product::create([
            'name' => $name,
            'price' => $price,
            
        ]);

        //  return redirect('formLogin');
         return view('admin.add_product');
    }

    public function product()
    {
        $products = Product::all();
        // dd($products);
        return view('admin.product', compact('products'));
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        // dd($products);
        return view('admin.edit_product', compact('product'));
    }

    public function update_product($id, Request $request)
    {

        Product::where('id', $id)->update(['price' =>$request->get('price')]);
        $product = Product::find($id);
        return view('admin.edit_product', compact('product'));
    }
}
