<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;
    protected $fillable = [
        'rank',
        'point',
    ];

    public function rank_coupon()
    {
        return $this->hasMany(Coupon::class, 'rank', 'id');
    }
}
