<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function Blog(){
        return $this->belongsTo('App\Blog');
    }
}
