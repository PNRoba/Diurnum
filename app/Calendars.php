<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calendars extends Model
{
    public function users() {
        return $this->belongsTo('App\User');
    }
    public function keywords() {
        return $this->belongsTo('App\Keywords');
    }
    public function tasks() {
        return $this->belongsTo('App\Tasks');
    }
}
