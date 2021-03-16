<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'quantity', 'chip', 'payment_method'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function foods()
    {
        return $this->belongsTo('App\Models\Food');
    }

    public function delivers()
    {
        return $this->belongsTo('App\Models\Deliver');
    }
}
