<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements AbstractRepositoryInterface
{
    public function show()
    {
        return Product::all();
    }
    public function create(array $attributes)
    {
        return Product::create($attributes);
    }
    public function getById($id)
    {
        return Product::find($id);
    }
    public function update($id, array $attributes)
    {
        $product = Product::find($id);
        $product->update($attributes);
        return $product;
    }
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}
