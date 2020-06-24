<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publics extends Model
{
    protected $table = 'public';
    
    public function keywords() {
        return $this->belongsTo('App\Keyword');
    }
}
