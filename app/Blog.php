<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];
    public function files(){
        return $this->hasMany('App\File');
    }
}
