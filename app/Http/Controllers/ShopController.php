<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;

class ShopController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function show()
    {

        $products = $this->productRepository->show();
        return view('demo.shop', compact('products'));
    }

}
