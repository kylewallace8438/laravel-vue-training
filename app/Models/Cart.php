<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'amount',
        'price',
        'discount_price',
    ];

    protected $attributes = [

        'discount_price' => -1,
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
