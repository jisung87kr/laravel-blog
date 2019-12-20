<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function Blog(){
        return $this->belongsTo('App\Blog');
    }
}
