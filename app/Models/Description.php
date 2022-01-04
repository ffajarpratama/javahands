<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $table = 'descriptions';
    protected $guarded = [];

    //one description to one product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
