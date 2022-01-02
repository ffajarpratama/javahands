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

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function getCountryName()
    {
        if ($this->state) {
            return Country::query()
                ->where('id', $this->state->country_id)
                ->value('name');
        }
        return null;
    }

    public function getCountryId()
    {
        if ($this->state) {
            return Country::query()
                ->where('id', $this->state->country_id)
                ->value('id');
        }
        return null;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
