<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function add_product_show(Request $request)
    {
        if ($request->user()->can('add', Product::class)) {
            return view('admin.add_product');
        } else {
            return redirect()->back()->with('error', 'Access is not allowed');
        }
    }

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

    public function show(Request $request)
    {
        if ($request->user()->can('delete', Product::class)) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Access is not allowed');
        }
    }

    public function product()
    {
        $products = Product::all();
        // dd($products);
        return view('admin.product', compact('products'));
    }

    public function edit_product(Request $request, $id)
    {
        if ($request->user()->can('update', Product::class)) {
            $product = Product::find($id);
            return view('admin.edit_product', compact('product'));
        } else {
            return redirect()->back()->with('error', 'Access is not allowed');
        }
    }

    public function update_product($id, Request $request)
    {
        Product::where('id', $id)->update(['price' => $request->get('price')]);
        $product = Product::find($id);
        return view('admin.edit_product', compact('product'));
    }

    public function delete(Request $request)
    {
        if ($request->user()->can('delete', Product::class)) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Access is not allowed');
        }
        // return redirect()->back();
    }
}
