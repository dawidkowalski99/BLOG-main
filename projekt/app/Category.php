<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['name'];

    /*
        wiele postów dla kategorii
    */
    public function posts(){
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
