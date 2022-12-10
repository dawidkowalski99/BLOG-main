<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogConfig extends Model
{

    protected $fillable = ['text', 'image', 'color', 'pagination'];
}
