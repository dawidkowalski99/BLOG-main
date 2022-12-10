<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Comments extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];


    protected $fillable = [
        'text'
    ];

    /**
     * autor komentarza
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * czas dodania postu
     *
     * @return integer
    */
    public function commentTime(){
        Carbon::setLocale(config('app.locale')); // lokalizacja PL
        $timestamp = $this->created_at;
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'Europe/Warsaw');
        return $date->diffForHumans();
    }
}
