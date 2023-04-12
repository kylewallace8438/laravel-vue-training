<?php
namespace App\Repositories;

use App\Models\Coupon;
use App\Models\CouponProduct;
use App\Models\CouponUser;

class CouponRepository implements CouponRepositoryInterface
{
    public function show()
    {
        return Coupon::all();
    }
    public function create(array $attributes)
    {
        return Coupon::create($attributes);
    }
    public function getById($id)
    {
        return Coupon::find($id);
    }
    public function update($id, array $attributes)
    {
        $coupon = Coupon::find($id);
        $coupon->update($attributes);
        return $coupon;
    }
    public function delete($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
    }
    public function createCouponUser(array $attributes)
    {
        CouponUser::create($attributes);
    }
    public function createCouponProduct(array $attributes)
    {
        CouponProduct::create($attributes);
    }
    public function getByCode($code)
    {
        $coupon = Coupon::where('code', $code)->first();
        return $coupon;
    }
    public function getCouponUserByCouponId($couponId)
    {
        $coupon_users = CouponUser::where('coupon_id', $couponId)->get();
        return $coupon_users;
    }
    public function getCouponProductByCouponId($couponId)
    {
        $coupon_products = CouponProduct::where('coupon_id', $couponId)->get();
        return $coupon_products;
    }

    public function getCouponbyUserCoupon($user,$id)
    {
        return CouponUser::where('user_id', $user->id)->where('coupon_id', $id)->first();
    }
}
