<?php
namespace App\Repositories;

use App\Models\Cart;

class CartRepository implements CartRepositoryInterface
{
    public function show()
    {
        return Cart::all();
    }
    public function create(array $attributes)
    {
        return Cart::create($attributes);
    }
    public function getById($id)
    {
        return Cart::find($id);
    }
    public function update($id, array $attributes)
    {
        $cart = Cart::find($id);
        $cart->update($attributes);
        return $cart;
    }
    public function delete($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
    }

    public function getByUserId($user)
    {
        $carts = Cart::where('user_id', $user)->get();
        return $carts;

    }
    public function getByUserIdProductId($user, $product)
    {
        $cart = Cart::where('user_id', $user)->where('product_id', $product)->first();
        return $cart;
    }
    public function deleteForUserId($user)
    {
        Cart::where('user_id', $user)->delete();

    }

    public function deleteForUserIdProductId($user, $product)
    {
        Cart::where('user_id', $user)->where('product_id', $product)->delete();

    }
    public function updateDiscountOfUser($user, $discount)
    {
        Cart::where('User_id', $user)->update(['discount_price' => $discount]);

    }
    public function updateDiscountForUserIdProductId($user, $product, $discount)
    {
        Cart::where('User_id', $user)->where('product_id', $product)->update(['discount_price' => $discount]);
    }

}
