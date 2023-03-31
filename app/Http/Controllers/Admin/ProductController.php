<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    //
    public function add_product(Request $request, User $user)
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

    public function show(User $user)
    {
        $this->authorize('view',Product::class);
        return redirect()->back();
    }

    public function product()
    {
        $products = Product::all();
        // dd($products);
        return view('admin.product', compact('products'));
    }

    public function edit_product($id, User $user)
    {
        $this->authorize('update',Product::class);
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

    public function delete(User $user)
    {
        $this->authorize('delete',Product::class);
        return redirect()->back();
    }
}
