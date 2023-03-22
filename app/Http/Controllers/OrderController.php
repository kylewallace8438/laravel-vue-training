<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show()
    {
        $user_id = Auth::id();
        $carts=[];
        if($user_id)
        {
            $order_id = Order::where('user_id', $user_id)->where('status', 0)->first();
            if ($order_id == NULL)
                $carts = OrderDetail::where('order_id', 0)->get();
            else
                $carts = OrderDetail::where('order_id', $order_id->id)->get();
            return view('demo.cart', compact('carts'));
        }
        else 
        return view('demo.cart', compact('carts'));
    }

    public function checkout()
    {   
        $user_id = Auth::id();
        $carts=[];
        if($user_id)
        {
            $order_id = Order::where('user_id', $user_id)->where('status', 0)->first();
            if ($order_id == NULL)
                $carts = OrderDetail::where('order_id', 0)->get();
            else
                $carts = OrderDetail::where('order_id', $order_id->id)->get();
            return view('demo.checkout', compact('carts'));
        }
        else 
        return view('demo.checkout', compact('carts'));
    }

    public function thankyou(Request $request)
    {
        $user_id = Auth::id();
        if($user_id)
        {
            $order_id = Order::where('user_id', $user_id)->where('status', 0)->first();
            if ($order_id != NULL)
            Order::where('id', $order_id->id)->update(['status' => 1]);
            return view('demo.thankyou');
        }
        else 
        return view('demo.thankyou');
        
    }

   
    public function add_cart(Request $request)
    {
        if (Auth::check()) {

            $product_id = $request->get('product_id');
            // return $product_id;
            $check = $request->get('check');
            $check_order = Order::where('user_id', Auth::id())->where('status', 0)->first();
            if (!isset($check_order->id)) {
                $order = ['user_id' => Auth::id()];
                Order::create($order);
            }

            $order_id = Order::where('user_id', Auth::id())->where('status', 0)->first();
            // session()->put('order_id',$order_id->id);
            $product = Product::find($product_id);

            $details = OrderDetail::where('order_id', $order_id->id)->where('product_id', $product_id)->first();
            if (!isset($details->id)) {
                $detail = ['order_id' => $order_id->id, 'product_id' => $product_id, 'price' => $product->price, 'discount_price' => $product->price, 'count' => 1];
                OrderDetail::create($detail);
            } else {
                if ($check < 0) {
                    $amount = 0;
                } elseif ($check == 0) {
                    if ($details->count > 0) {
                        $amount = $details->count - 1;
                    } else {
                        $amount = 0;
                    }
                } elseif ($check == 1) {
                    $amount = $details->count + 1;
                } else {
                    $amount = $check;
                }
                $detail = ['order_id' => $order_id->id, 'product_id' => $product_id, 'price' => $product->price, 'discount_price' => $product->price, 'count' => $amount];
                OrderDetail::where('id', $details->id)->update($detail);
            }

            $order_details = OrderDetail::where('order_id', $order_id->id)->get();
            return response()->json($order_details);
            // return $order_details;
            // dd($order_details);
        }
    }

    
}
