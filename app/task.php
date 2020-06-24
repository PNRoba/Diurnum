<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['title','color','start_date','end_date'];
    
    public function calendars()
    {
        return $this->belongsTo('App\Calendar');
    }
}
