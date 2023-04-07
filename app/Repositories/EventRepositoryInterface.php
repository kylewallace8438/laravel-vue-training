<?php

namespace App\Repositories;

interface EventRepositoryInterface extends AbstractRepositoryInterface
{
    public function getExchange();
    public function getCoupon();
    public function getRank();
    public function getIdbyCoupon($coupon);
    public function updatebyCoupon($coupon, $rank, $point);
    public function getIdbyRank($rank);
    public function getRankPoint($id);
    public function getCouponofUser();
    public function updatePoint($user,$current_point);
}
