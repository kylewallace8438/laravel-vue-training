<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'action',
    ];

    public function admin_role()
    {
        return $this->hasMany(AdminRole::class);
    }
}
