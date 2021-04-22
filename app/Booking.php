<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['quantity'];

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
