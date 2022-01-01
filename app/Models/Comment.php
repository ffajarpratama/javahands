<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    public function isAuthUserLikedPost()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function isAuthUserDislikedPost()
    {
        return $this->dislikes()->where('user_id', auth()->id())->exists();
    }

    public function reply()
    {
        return $this->hasOne(Reply::class);
    }
}
