<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //This method allows relationship between posts table and comments table
    public function post(){
        return $this->belongsTo('App\Post','post_id','id');
    }
}
