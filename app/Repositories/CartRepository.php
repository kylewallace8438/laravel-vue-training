<?php
namespace App\Repositories;

use App\Models\Cart;

class CartRepository implements AbstractRepositoryInterface
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
}
