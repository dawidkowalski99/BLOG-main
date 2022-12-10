<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Calendar;
use Auth;

class WelcomeController extends Controller
{

    public function index()
    {
        $events = Calendar::latest()->get();
        
        $eventtoday = 0; // dzisiejszy dzień
        foreach($events as $event){
            if($event->eventToDay() && $event->user_id == Auth::user()->id){
                $eventtoday++;
            }
        }
        return view('welcome', compact('eventtoday'));
    }

}
