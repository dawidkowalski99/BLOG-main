<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Calendar extends Model
{

    protected $fillable = ['title', 'description', 'start_time', 'end_time'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }



    public function eventToDay(){
        $date = new Carbon($this->end_time);
        $end_time = Carbon::createFromDate($date->year, $date->month, $date->day, 'Europe/Warsaw');

        if($end_time->diffInDays() == 0){
            return true; 
        }
    }


    public function eventTime(){

 
        if($this->end_time == null) return 0;


        Carbon::setLocale(config('app.locale')); // lokalizacja - PL
        $timestamp = $this->end_time;
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'Europe/Warsaw');
        return $date->diffForHumans();
    }
}
