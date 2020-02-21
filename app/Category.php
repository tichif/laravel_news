<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Creating a method witch allows relationship with Post model
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
