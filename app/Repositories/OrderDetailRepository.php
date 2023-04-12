<?php
namespace App\Repositories;

use App\Models\OrderDetail;

class OrderDetailRepository implements AbstractRepositoryInterface
{
    public function show()
    {
        return OrderDetail::all();
    }
    public function create(array $attributes)
    {
        return OrderDetail::create($attributes);
    }
    public function getById($id)
    {
        return OrderDetail::find($id);
    }
    public function update($id, array $attributes)
    {
        $orderDetail = OrderDetail::find($id);
        $orderDetail->update($attributes);
        return $orderDetail;
    }
    public function delete($id)
    {
        $orderDetail = OrderDetail::find($id);
        $orderDetail->delete();
    }
}
