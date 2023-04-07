<?php

namespace App\Repositories;

interface CouponRepositoryInterface extends AbstractRepositoryInterface
{
    public function createCouponUser(array $attributes);
    public function createCouponProduct(array $attributes);
    public function getByCode($code);
    public function getCouponUserByCouponId($couponId);
    public function getCouponProductByCouponId($couponId);
    public function getCouponbyUserCoupon($user,$id);


}
