<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\Product;

class CouponController extends Controller
{
    public function createCoupon()
    {
        $products = Product::all();

        return view('admin.createCoupon', compact('products'));
    }

    public function storeCoupon(CouponRequest $request)
    {
        $form_data = [
            'code' => $request->code,
            'type_price' => $request->type_price,
            'price' => $request->price,
            'des' => $request->des,
        ];

        Coupon::create($form_data);

        return redirect()->route('coupon.create')->with('success', 'Thêm dữ liệu thành công');
    }
}
