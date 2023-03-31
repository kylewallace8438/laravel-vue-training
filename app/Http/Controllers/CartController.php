<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function show()
    {

        $user_id = Auth::user()->id;

        $carts = Cart::where('user_id', $user_id)->get();

        return view('demo.cart', compact('carts'));
    }

    public function add_cart(Request $request)
    {
        $user_id = Auth::user()->id;
        $product_id = $request->get('product_id');
        $check = $request->get('check');
        $check_cart = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();
        $product = Product::find($product_id);

        if ($check_cart == null) {
            $cart = ['user_id' => $user_id, 'product_id' => $product_id, 'price' => $product->price, 'amount' => 1];
            Cart::create($cart);
        } else {
            if ($check < 0) {
                $amount = 0;
            } elseif ($check == 0) {
                if ($check_cart->amount > 0) {
                    $amount = $check_cart->amount - 1;
                } else {
                    $amount = 0;
                }
            } elseif ($check == 1) {
                $amount = $check_cart->amount + 1;
            } else {
                $amount = $check;
            }
            $cart = ['user_id' => $user_id, 'product_id' => $product_id, 'price' => $product->price, 'amount' => $amount];
            Cart::where('id', $check_cart->id)->update($cart);
        }

        $cart = Cart::where('user_id', $user_id)->get();
        return response()->json($cart);

    }

    public function check_out()
    {

        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->get();

        return view('demo.checkout', compact('carts'));
    }

    public function thank(Request $request)
    {
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->get();
        $order = ['user_id' => $user_id, 'create_time' => date("Y-m-d"), 'return_time' => date("Y-m-d")];
        $newOrder = Order::create($order);

        foreach ($carts as $cart) {
            if ($cart->discount_price == -1) {
                $discount_price = $cart->price;
            } else {
                $discount_price = $cart->discount_price;

            }
            OrderDetail::create([
                'order_id' => $newOrder->id,
                'product_id' => $cart->product_id,
                'price' => $cart->price,
                'discount_price' => $discount_price,
                'amount' => $cart->amount,
            ]);
        }
        Cart::where('user_id', $user_id)->delete();

        return view('demo.thankyou');

    }

}