<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'price_type',
        'des',
        'price',
        'start',
        'end',
        'condition',
        'point',
    ];

    protected $attributes = [
        'rank' => 0,
    ];

    public function rank_id()
    {
        return $this->belongsTo(Rank::class, 'rank', 'id');
    }
}
