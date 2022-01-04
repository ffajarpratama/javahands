<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    use HasFactory;

    protected $table = 'dislikes';
    protected $guarded = [];

    //many dislikes to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //many dislikes to one comment
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
