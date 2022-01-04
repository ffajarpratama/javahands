<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $table = 'replies';
    protected $guarded = [];

    //one reply to one comment
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
