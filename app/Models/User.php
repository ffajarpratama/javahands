<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $guarded = [];
    protected $hidden = [
        'remember_token',
    ];

    //method buat gabungin nama depan dan nama belakang user
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    //one user to many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //one user to many likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //one user to many dislikes
    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    //one user to many carts
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    //many users to one state
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    //method buat ambil nama country user
    public function getCountryName()
    {
        if ($this->state) {
            return Country::query()
                ->where('id', $this->state->country_id)
                ->value('name');
        }
        return null;
    }

    //method buat ambil id country user
    public function getCountryId()
    {
        if ($this->state) {
            return Country::query()
                ->where('id', $this->state->country_id)
                ->value('id');
        }
        return null;
    }

    //one user to many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
