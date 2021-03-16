<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function shops()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
