<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendars';
    protected $fillable = ['user_id','keywords_id','tasks_id'];
    
    public function users() {
        return $this->belongsTo('App\User');
    }
    public function keywords() {
        return $this->belongsTo('App\Keyword');
    }
    public function tasks() {
        return $this->belongsTo('App\Task');
    }
}
