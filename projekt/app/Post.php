<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'contents', 'publish', 'image'
    ];

    /**
     * autor postu
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * kategorie postu
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    /**
     * komentarze postu
     */
    public function comments(){
        return $this->hasMany('App\Comments')->withTrashed();
    }

    /**
     * sprawdzenie kategorii postu
     */
    public function hasCategory($category){
        if($this->categories()->where('name', $category)->first()){
            return true;
        }
        return false;
    }

    /**
     *  id kategorii postu
     */
    public function getCategoryListAttribute()
    {
        return $this->categories->pluck('id')->all();
    }
}
