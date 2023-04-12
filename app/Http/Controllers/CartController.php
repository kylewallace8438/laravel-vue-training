<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Cart;
use App\Repositories\CartRepository;
use App\Repositories\CouponRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartRepository;
    protected $productRepository;
    protected $orderRepository;
    protected $couponRepository;
    protected $orderDetailRepository;

    public function __construct
    (
        CartRepository $cartRepository, ProductRepository $productRepository,
        OrderRepository $orderRepository, OrderDetailRepository $orderDetailRepository
        , CouponRepository $couponRepository
    ) {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->couponRepository = $couponRepository;
        $this->orderDetailRepository = $orderDetailRepository;

    }
    public function show()
    {

        $user_id = Auth::user()->id;

        $carts = $this->cartRepository->getByUserId($user_id);

        return view('demo.cart', compact('carts'));
    }

    public function addCart(Request $request)
    {
        $user_id = Auth::user()->id;
        $product_id = $request->get('product_id');
        $check = $request->get('check');

        $check_cart = $this->cartRepository->getByUserIdProductId($user_id, $product_id);
        $product = $this->productRepository->getById($product_id);

        if ($check_cart == null) {
            $cart = ['user_id' => $user_id, 'product_id' => $product_id, 'price' => $product->price, 'amount' => 1];
            $this->cartRepository->create($cart);
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
            $this->cartRepository->update($check_cart->id, $cart);
        }

        $cart = $this->cartRepository->getByUserId($user_id);
        return response()->json($cart);
    }

    public function removeProduct($id)
    {

        $user_id = Auth::user()->id;
        $this->cartRepository->deleteForUserIdProductId($user_id, $id);
        $value = Session::get('coupon');

        if ($value != null) {
            Session::forget('coupon');
            $this->cartRepository->updateDiscountOfUser($user_id, -1);

            $carts = $this->cartRepository->getByUserId($user_id);

            return view('demo.cart', compact('carts'));
        } else {
            $carts = $this->cartRepository->getByUserId($user_id);

            return view('demo.cart', compact('carts'));
        }
    }

    public function checkOut()
    {

        $user_id = Auth::user()->id;

        $carts = $this->cartRepository->getByUserId($user_id);

        return view('demo.checkout', compact('carts'));
    }

    public function removeCouponInCheckout()
    {

        $user_id = Auth::user()->id;
        Session::forget('coupon');

        $this->cartRepository->updateDiscountOfUser($user_id, -1);
        $carts = $this->cartRepository->getByUserId($user_id);

        session()->flash('status', 'Cancel coupon successfully!');
        return view('demo.checkout', compact('carts'));
    }

    public function thank(Request $request)
    {
        $now = Carbon::now();
        $date = $now->toDateTimeString();
        $user = Auth::user();
        $user_id = $user->id;

        $carts = $this->cartRepository->getByUserId($user_id);
        Mail::to($user->email)->send(new WelcomeMail($user, $carts, 1));
        $value = Session::get('coupon');
        if ($value == null) {
            $order = ['user_id' => $user_id, 'create_time' => $date, 'return_time' => $date];
        } else {
            $order = ['user_id' => $user_id, 'coupon_id' => $value->id, 'create_time' => $date, 'return_time' => $date];
            Session::forget('coupon');
        }

        $newOrder = $this->orderRepository->create($order);

        foreach ($carts as $cart) {
            if ($cart->discount_price == -1) {
                $discount_price = $cart->price;
            } else {
                $discount_price = $cart->discount_price;
            }
            $this->orderDetailRepository->create([
                'order_id' => $newOrder->id,
                'product_id' => $cart->product_id,
                'price' => $cart->price,
                'discount_price' => $discount_price,
                'amount' => $cart->amount,
            ]);
        }
        $this->cartRepository->deleteForUserId($user_id);

        return view('demo.thankyou');
    }

    public function applyCoupon(Request $request)
    {

        $user_id = Auth::user()->id;
        $coupon_code = $request->get('coupon');
        $coupon = $this->couponRepository->getByCode($coupon_code);

        if ($coupon == null) {
            $coupon_users = $this->couponRepository->getCouponUserByCouponId(-1);
        } else {
            $coupon_users = $this->couponRepository->getCouponUserByCouponId($coupon->id);
        }
        //cancel apply coupon old
        $value = Session::get('coupon');
        if ($value != null) {
            Session::forget('coupon');
        }
        $carts = $this->cartRepository->getByUserId($user_id);
        $total = 0;
        foreach ($carts as $cart) {
            $this->cartRepository->updateDiscountForUserIdProductId($user_id, $cart->id, -1);
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

                    $coupon_products = $this->couponRepository->getCouponProductByCouponId($coupon->id);
                    foreach ($coupon_products as $coupon_product) {
                        foreach ($carts as $cart) {
                            if ($coupon_product->product_id == $cart->product_id) {
                                $cart_product = $this->cartRepository->getByUserIdProductId($user_id, $cart->product_id);
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
                                $this->cartRepository->update($cart_product->id, ['discount_price' => $discount_price]);
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

        $carts = $this->cartRepository->getByUserId($user_id);

        return view('demo.cart', compact('carts'));
    }

    public function removeCoupon()
    {

        $user_id = Auth::user()->id;
        Session::forget('coupon');

        $this->cartRepository->updateDiscountOfUser($user_id, -1);
        $carts = $this->cartRepository->getByUserId($user_id);
        session()->flash('status', 'Cancel coupon successfully!');
        return view('demo.cart', compact('carts'));
    }
}
