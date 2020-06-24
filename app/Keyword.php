<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $table = 'keywords';
    protected $fillable = ['name','color','public','user_id'];
    
    public function calendars()
    {
        return $this->hasMany('App\Calendar');
    }
    public function publics()
    {
        return $this->hasMany('App\Publics');
    }
    public function users() {
        return $this->belongsTo('App\User');
    }
}
