<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        return view('demo.cart');
    }

    public function add_cart(Request $request)
    {
        // session()->forget('carts');
        $d = false;
        $product_id = $request->get('product_id');
        $check = $request->get('check');
        $name = $request->get('name');
        $price = $request->get('price');
        $show = "Them That Bai";
        // $request->session()->push('carts',['product_id' => $product_id, 'amount' => $amount]);
        if ($request->session()->has('carts')) {
            $carts = [];
            $t = 0;
            foreach (session('carts') as $cart => $order) {
                array_push($carts, [
                    'product_id' => session('carts')[$t]['product_id'], 'amount' => session('carts')[$t]['amount'], 'name' => session('carts')[$t]['name'],
                    'price' => session('carts')[$t]['price'], 'sub_total' => (session('carts')[$t]['sub_total'])
                ]);
                if ($carts[$t]['product_id'] == $product_id) {
                    if ($check == 1) {
                        $carts[$t]['amount'] +=  1;
                    } elseif ($carts[$t]['amount'] > 0 && $check == -1) {
                        $carts[$t]['amount'] -=  1;
                    } else {
                        $carts[$t]['amount'] =  $check;
                    }
                    $carts[$t]['sub_total'] =  $carts[$t]['price'] * $carts[$t]['amount'];
                    $d = true;
                }
                $t = $t + 1;
            }

            if ($d == false) {
                array_push($carts, ['product_id' => $product_id, 'amount' => 1, 'name' => $name, 'price' => $price, 'sub_total' => $price]);
            }

            session()->put('carts', $carts);
            $show = "Them Thanh cong";
        } else {
            $carts = [];
            array_push($carts, ['product_id' => $product_id, 'amount' => 1, 'name' => $name, 'price' => $price, 'sub_total' => $price]);
            session()->put('carts', $carts);
            $show = "Them Thanh cong";
        }



        return response()->json($carts);
        // return response()->json(array('msg' => $show));
    }

    public function check_out()
    {
        return view('demo.checkout');
    }

    public function thank()
    {
        session()->forget('carts');
        return view('demo.thankyou');
    }
}
