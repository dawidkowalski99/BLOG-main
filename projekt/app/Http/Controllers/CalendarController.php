<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Calendar;
use Auth;
use Session;
use Carbon\Carbon;

class CalendarController extends Controller
{

    public function index()
    {
        $events = Calendar::where('user_id', Auth::user()->id)->orderBY('end_time', 'DSC')->get();
        return view('calendar.index', compact('events'));
    }


    public function create()
    {
        $now = \Carbon\Carbon::now();
        return view('calendar.create', compact('now'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:25', 
            'description' => 'required|max:100', 
            'start_time' => 'required|date|date_format:Y-m-d H:i:s|before:end_time',
            'end_time' => 'required|date|date_format:Y-m-d H:i:s|after:start_time'
            ]);

        $event = new Calendar($request->all());
        $event->user_id = Auth::user()->id;
        $event->save();

        Session::flash('message', 'Wydarzenie zostało dodane');

        return redirect('/calendar');
    }
    public function destroy($id)
    {
        $event = Calendar::findOrFail($id);
        $event->delete();

        Session::flash('message', 'Wydarzenie zostało usunięty');

        return redirect('/calendar');
    }
}
