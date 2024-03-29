<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password','address', 'phone_number', 'image_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function foods()
    {
        return $this->hasMany('App\Models\Food');
    }

    public function shops()
    {
        return $this->belongsToMany('App\Models\Shop', 'likes')->withTimestamps();
    }

    public function addresses()
    {
        return $this->belongsToMany('App\Address')->withTimestamps();
    }
}
