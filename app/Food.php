<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = [
        'name', 'description', 'cooking_time', 'price', 'tax_rate', 'image_name'
    ];

    public function shops()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function delivers()
    {
        return $this->belongsTo('App\Models\Deliver');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}
