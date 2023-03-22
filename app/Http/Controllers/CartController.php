<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    public function show()
    {
        $carts = [];
        $user_id = Auth::user()->id;
        // $order_id = Auth::user()->order->where('status', 0)->first();
        $order_id = Order::where('user_id', $user_id)->where('status', 0)->first();
        // $carts = $order_id -> order_detail;
        if($order_id == null){
            $carts = OrderDetail::where('order_id', 0)->get();
        } else {
            $carts = OrderDetail::where('order_id', $order_id -> id)->get();
        }
        return view('demo.cart', compact('carts'));
    }

    // use session

    // public function add_cart(Request $request)
    // {
    //     // session()->forget('carts');
    //     $d = false;
    //     $product_id = $request->get('product_id');
    //     $check = $request->get('check');
    //     $name = $request->get('name');
    //     $price = $request->get('price');
    //     $show = "Them That Bai";
    //     // $request->session()->push('carts',['product_id' => $product_id, 'amount' => $amount]);
    //     if ($request->session()->has('carts')) {
    //         $carts = [];
    //         $t = 0;
    //         foreach (session('carts') as $cart => $order) {
    //             array_push($carts, [
    //                 'product_id' => session('carts')[$t]['product_id'], 'amount' => session('carts')[$t]['amount'], 'name' => session('carts')[$t]['name'],
    //                 'price' => session('carts')[$t]['price'], 'sub_total' => (session('carts')[$t]['sub_total'])
    //             ]);
    //             if ($carts[$t]['product_id'] == $product_id) {
    //                 if ($check == 1) {
    //                     $carts[$t]['amount'] +=  1;
    //                 } elseif ($carts[$t]['amount'] > 0 && $check == 0) {
    //                     $carts[$t]['amount'] -=  1;
    //                 } else {
    //                     $carts[$t]['amount'] =  $check;
    //                 }
    //                 $carts[$t]['sub_total'] =  $carts[$t]['price'] * $carts[$t]['amount'];
    //                 $d = true;
    //             }
    //             $t = $t + 1;
    //         }

    //         if ($d == false) {
    //             array_push($carts, ['product_id' => $product_id, 'amount' => 1, 'name' => $name, 'price' => $price, 'sub_total' => $price]);
    //         }

    //         session()->put('carts', $carts);
    //         $show = "Them Thanh cong";
    //     } else {
    //         $carts = [];
    //         array_push($carts, ['product_id' => $product_id, 'amount' => 1, 'name' => $name, 'price' => $price, 'sub_total' => $price]);
    //         session()->put('carts', $carts);
    //         $show = "Them Thanh cong";
    //     }



    //     return response()->json($carts);
    //     // return response()->json(array('msg' => $show));
    // }

    public function add_cart(Request $request)
    {
        $user_id = Auth::user()->id;
        $product_id = $request->get('product_id');
        $check = $request->get('check');
        $check_order = Auth::user()->order->where('status', 0)->first();
        // $check_order = Order::where('user_id', $user_id)->where('status', 0)->first();
        if (!isset($check_order->id)) {
            $order = ['user_id' => $user_id];
            Order::create($order);
        }

        $order_id = Order::where('user_id', $user_id)->where('status', 0)->first();
        $product = Product::find($product_id);

        $details = OrderDetail::where('order_id', $order_id->id)->where('product_id', $product_id)->first();
        if (!isset($details->id)) {
            $detail = ['order_id' => $order_id->id, 'product_id' => $product_id, 'price' => $product->price, 'discount_price' => $product->price, 'amount' => 1];
            OrderDetail::create($detail);
        } else {
            if ($check < 0) {
                $amount = 0;
            } elseif ($check == 0) {
                if ($details->amount > 0) {
                    $amount = $details->amount - 1;
                } else {
                    $amount = 0;
                }
            } elseif ($check == 1) {
                $amount = $details->amount + 1;
            } else {
                $amount = $check;
            }
            $detail = ['order_id' => $order_id->id, 'product_id' => $product_id, 'price' => $product->price, 'discount_price' => $product->price, 'amount' => $amount];
            OrderDetail::where('id', $details->id)->update($detail);
        }

        $order_details = OrderDetail::where('order_id',$order_id->id)->get();
        return response()->json($order_details);
        // return $order_details;
        // dd($order_details);
    }


    public function check_out()
    {
        $carts = [];
        $user_id = Auth::user()->id;
        $order_id = Order::where('user_id', $user_id)->where('status', 0)->first();
        if($order_id != null){
            $carts = OrderDetail::where('order_id', $order_id -> id)->get();
        }
        return view('demo.checkout',compact('carts'));
    }

    public function thank(Request $request)
    {
        $user_id = Auth::user()->id;
        $order_id = Order::where('user_id', $user_id)->where('status', 0)->first();
        if($order_id != null){
            Order::where('id', $order_id->id)->update(['status' => 1]);
        }
        return view('demo.thankyou');
    }
}
