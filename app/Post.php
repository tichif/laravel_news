<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Creating a method witch allows relationship with User model
    public function creator(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}