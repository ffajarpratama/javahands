<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];

    //method buat hitung harga diskon product
    public function getDiscountedPrice()
    {
        //cek kalo product punya diskon
        if ($this->discount != 0) {
            $price = $this->price;
            return $price - ($price * ($this->discount / 100));
        }
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function description()
    {
        return $this->hasOne(Description::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
