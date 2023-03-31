<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponProduct;
use App\Models\CouponUser;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function show_createCoupon()
    {
        $products = Product::all();
        $users = User::where('role_user', 2)->get();
        return view('admin.createCoupon', compact('products', 'users'));
    }

    public function create_Coupon(Request $request)
    {
        $users_coupon = $request->get('user');

        $products_coupon = $request->get('product');
        $Coupon = Coupon::create([
            'code' => $request->get('code'),
            'des' => $request->get('des'),
            'price_type' => $request->get('price_type'),
            'price' => $request->get('price'),
            'condition' => $request->get('condition'),
            'start' => $request->get('date_start'),
            'end' => $request->get('date_end'),
            'point' => 0,
        ]);

        //store user_coupon
        $Coupon_id = $Coupon->id;
        if (strcmp($users_coupon[0], 'All') == 0) {
            $users = User::all();
            foreach ($users as $user) {
                CouponUser::create([
                    'user_id' => $user->id,
                    'coupon_id' => $Coupon_id,
                ]);
            }
        } else {
            foreach ($users_coupon as $user) {
                $user_id = User::where('name', $user)->first();
                CouponUser::create([
                    'user_id' => $user_id->id,
                    'coupon_id' => $Coupon_id,
                ]);
            }
        }

        //store product_coupon
        if (strcmp($products_coupon[0], 'All') == 0) {
            $products = Product::all();
            foreach ($products as $product) {
                CouponProduct::create([
                    'product_id' => $product->id,
                    'coupon_id' => $Coupon_id,
                ]);
            }
        } else {
            foreach ($products_coupon as $product) {
                $product_id = Product::where('name', $product)->first();
                CouponProduct::create([
                    'product_id' => $product_id->id,
                    'coupon_id' => $Coupon_id,
                ]);
            }
        }
        $products = Product::all();
        $users = User::where('role_user', 2)->get();
        return view('admin.createCoupon', compact('products', 'users'));
    }

    public function show_ListCoupon()
    {
        $coupons = Coupon::all();

        return view('admin.listCoupon', compact('coupons'));
    }
}
