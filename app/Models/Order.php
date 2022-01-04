<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = [];

    //many orders to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //one order to many carts
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
