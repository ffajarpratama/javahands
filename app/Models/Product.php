<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

//    public function users()
//    {
//        return $this->belongsToMany(User::class, 'comments', 'product_id', 'user_id')
//            ->as('comment')
//            ->withPivot(['description', 'rating', 'picture'])
//            ->withTimestamps();
//    }
}
