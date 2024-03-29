<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function addProduct(Request $request)
    {

        $name = $request->get('name');
        $price = $request->get('price');

        $product = [
            'name' => $name,
            'price' => $price,
        ];
        $this->productRepository->create($product);
        return view('admin.add_product');
    }


    public function addProductShow(Request $request)

    {
        if ($request->user()->can('add', Product::class)) {
            return view('admin.add_product');
        } else {
            return redirect()->back()->with('error', 'Access is not allowed');
        }
    }

    //

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
        $products = $this->productRepository->show();
        // dd($products);
        return view('admin.product', compact('products'));
    }

    public function editProduct(Request $request, $id)
    {
        if ($request->user()->can('update', Product::class)) {
            $product = $this->productRepository->getById($id);
            return view('admin.edit_product', compact('product'));
        } else {
            return redirect()->back()->with('error', 'Access is not allowed');
        }
    }

    public function updateProduct($id, Request $request)
    {
        $product = ['price' => $request->get('price')];
        $this->productRepository->update($id, $product);
        $product = $this->productRepository->getById($id);
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