<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponProduct;
use App\Models\CouponUser;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function remove_product($id)
    {

        $user_id = Auth::user()->id;
        Cart::where('user_id', $user_id)->where('product_id', $id)->delete();
        $value = Session::get('coupon');

        if ($value != null) {
            Session::forget('coupon');

            Cart::where('User_id', $user_id)->update(['discount_price' => -1]);

            $carts = Cart::where('user_id', $user_id)->get();
            return view('demo.cart', compact('carts'));
        } else {
            $carts = Cart::where('user_id', $user_id)->get();

            return view('demo.cart', compact('carts'));
        }

    }

    public function check_out()
    {

        $user_id = Auth::user()->id;

        $carts = Cart::where('user_id', $user_id)->get();

        return view('demo.checkout', compact('carts'));
    }

    public function remove_coupon()
    {

        $user_id = Auth::user()->id;
        Session::forget('coupon');

        Cart::where('User_id', $user_id)->update(['discount_price' => -1]);
        $carts = Cart::where('user_id', $user_id)->get();

        return view('demo.checkout', compact('carts'));
    }

    public function thank(Request $request)
    {
        $now = Carbon::now();
        $date = $now->toDateTimeString();
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->get();
        $value = Session::get('coupon');
        if ($value == null) {
            $order = ['user_id' => $user_id, 'create_time' => $date, 'return_time' => $date];
        } else {
            $order = ['user_id' => $user_id, 'coupon_id' => $value->id, 'create_time' => $date, 'return_time' => $date];
            Session::forget('coupon');
        }

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

    public function apply_coupon(Request $request)
    {

        $user_id = Auth::user()->id;
        $coupon_code = $request->get('coupon');
        $coupon = Coupon::where('code', $coupon_code)->first();

        if ($coupon == null) {
            $coupon_users = CouponUser::where('coupon_id', -1)->get();
        } else {
            $coupon_users = CouponUser::where('coupon_id', $coupon->id)->get();
        }
        //cancel apply coupon old
        $value = Session::get('coupon');
        if ($value != null) {
            Session::forget('coupon');
        }
        $carts = Cart::where('user_id', $user_id)->get();
        $total = 0;
        foreach ($carts as $cart) {
            Cart::where('User_id', $user_id)->where('product_id', $cart->id)->update(['discount_price' => -1]);
            $total = $total + $cart->price * $cart->amount;
        }

        $check = 0;
        foreach ($coupon_users as $coupon_user) {
            if ($coupon_user->user_id == $user_id) {
                $check = 1;
                break;
            }
        }
        if ($check == 1) {
            $current_date = date("Y-m-d");
            if ($current_date >= $coupon->start && $current_date <= $coupon->end) {

                if ($coupon->condition <= $total) {
                    Session::put('coupon', $coupon);

                    $coupon_products = CouponProduct::where('coupon_id', $coupon->id)->get();
                    foreach ($coupon_products as $coupon_product) {
                        foreach ($carts as $cart) {
                            if ($coupon_product->product_id == $cart->product_id) {
                                $cart_product = Cart::where('user_id', $user_id)->where('product_id', $cart->product_id)->first();
                                if ($coupon->price_type == 1) {
                                    $discount_price = $cart_product->price - $cart_product->price * $coupon->price / 100;
                                } else {
                                    if ($cart_product->price > $coupon->price) {
                                        $discount_price = $cart_product->price - $coupon->price;
                                    } else {
                                        $discount_price = 0;
                                    }
                                }
                                Cart::where('id', $cart_product->id)->update(['discount_price' => $discount_price]);
                                break;
                            }
                        }
                    }
                    session()->flash('status', 'Coupon applied successfully!');
                } else {

                    session()->flash('status', 'The order total is not enough to apply the coupon!');

                }
            } else {

                session()->flash('status', 'Currently the coupon is not open!');
            }
        } else {

            session()->flash('status', 'Coupon does not apply to you!');
        }

        $carts = Cart::where('user_id', $user_id)->get();

        return view('demo.cart', compact('carts'));
    }

}
