<?php
namespace App\Repositories;

use App\Models\Order;

class OrderRepository implements AbstractRepositoryInterface
{
    public function show()
    {
        return Order::all();
    }
    public function create(array $attributes)
    {
        return Order::create($attributes);
    }
    public function getById($id)
    {
        return Order::find($id);
    }
    public function update($id, array $attributes)
    {
        $order = Order::find($id);
        $order->update($attributes);
        return $order;
    }
    public function delete($id)
    {
        $order = Order::find($id);
        $order->delete();
    }
}
