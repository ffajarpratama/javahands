<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';
    protected $guarded = [];

    //many likes to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //many likes to one comment
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
