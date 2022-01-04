<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $guarded = [];

    //many comments to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //many comments to one user
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //one comment to many likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //one comment to many dislikes
    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    //method buat ngecek user udah ngelike comment atau belum
    public function isAuthUserLikedComment()
    {
        //cek di table likes id user yang login ada atau tidak
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    //method buat ngecek user udah ngedislike comment atau belum
    public function isAuthUserDislikedComment()
    {
        //cek di table dislikes id user yang login ada atau tidak
        return $this->dislikes()->where('user_id', auth()->id())->exists();
    }

    //one comment to one reply
    public function reply()
    {
        return $this->hasOne(Reply::class);
    }
}
