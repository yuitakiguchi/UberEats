<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
}
