<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {

         $products = [
             [
                'product_id' => '1',
                'price' => '34.45',
                'name' => 'Nordic Chair',
            ],
            [
                'product_id' => '2',
                'price' => '44.45',
                'name' => 'Kruzo Aero Chair',
            ],
            [
                'product_id' => '3',
                'price' => '54.45',
                'name' => 'Ergonomic Chair',
            ],
           [
                'product_id' => '4',
                'price' => '14.45',
                'name' => 'Nordic Chair1',
            ],
          
            [
                'product_id' => '5',
                'price' => '24.45',
                'name' => 'Kruzo Aero Chair1',
            ],
            [
                'product_id' => '6',
                'price' => '4.45',
                'name' => 'Ergonomic Chair1',
            ],
        ];

        session()->put('products', $products);
        return view('demo.shop');
    }

    public function add_cart(Request $request)
    {       
        // session()->forget('carts');

        // return $request->product_id;
        $d = false;
        $product_id = $request->get('product_id');
        // $amount = $request->get('amount');
        $amount = $request->get('amount');
        $price = $request->get('price');
        $name = $request->get('name');
        $show = "Them That Bai";
        // $request->session()->push('carts',['product_id' => $product_id, 'amount' => $amount]);
        
            if ($request->session()->has('carts')) {
                $carts = [];
                $t = 0;
                foreach (session('carts') as $cart => $order) {
                    // array_push($carts, ['product_id' => session('carts')[$t]['product_id'], 'amount' => session('carts')[$t]['amount']]);
                    array_push($carts, ['product_id' => session('carts')[$t]['product_id'], 'amount' => session('carts')[$t]['amount'],
                    'price' => session('carts')[$t]['price'],'name' => session('carts')[$t]['name']]);
                

                    if ($carts[$t]['product_id'] == $product_id) {
                        $carts[$t]['amount'] +=  $amount;
                        if($carts[$t]['amount']<0)
                        $carts[$t]['amount']=0;
                        if($amount==0){
                            unset($carts[$t]);
                            $t -=1;
                        }
                        $d = true;
                    }
                    $t = $t + 1;
                }

                if ($d == false) {
                    array_push($carts, ['product_id' => $product_id, 'amount' => $amount, 'price' => $price, 'name' => $name]);
                }
                // if($amount==0)
                // unset($cart['{{ $product_id }}']);
                session()->put('carts', $carts);
            } else {
                $carts = [];
                array_push($carts, ['product_id' => $product_id, 'amount' => $amount, 'price' => $price, 'name' => $name]);

                session()->put('carts', $carts);
                
            }
            $show = "Them Thanh cong";
            // session()->forget('carts');
            return response()->json($carts);
        

        return response()->json(array('msg' => $show));

    }

    public function cart()
    {
        return view('demo.cart');
    }

    }


