<?php
namespace App\Repositories;

use App\Models\Coupon;

class CouponRepository implements AbstractRepositoryInterface
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
}
