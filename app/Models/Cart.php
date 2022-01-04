<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $guarded = [];

    //many carts to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //many carts to one product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //many carts to one order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
