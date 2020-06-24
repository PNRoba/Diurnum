<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tasks extends Model
{
    public function calendars()
    {
        return $this->belongsTo('App\Calendars');
    }
}
