<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keywords extends Model
{
    public function calendars()
    {
        return $this->hasMany('App\Calendars');
    }
    public function users() {
        return $this->belongsTo('App\User');
    }
}
