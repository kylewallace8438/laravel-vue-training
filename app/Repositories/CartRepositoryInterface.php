<?php

namespace App\Repositories;

interface CartRepositoryInterface extends AbstractRepositoryInterface
{
    public function getByUserId($user);
    public function getByUserIdProductId($user, $product);
    public function deleteForUserIdProductId($user, $product);
    public function deleteForUserId($user);
    public function updateDiscountOfUser($user, $discount);
    public function updateDiscountForUserIdProductId($user, $product, $discount);

}
