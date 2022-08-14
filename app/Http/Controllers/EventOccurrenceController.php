<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventOccurrence;
use App\Models\EventSignup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventOccurrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('events.occurrences.create', ["event" => $event]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $event_id)
    {
        $datetime = Carbon::parse($request->get("occurrence_date"));

        $occurrence = new EventOccurrence();
        $occurrence->event_id = $event_id;
        $occurrence->scheduled_datetime = $datetime;
        $occurrence->save();

        session()->flash("status","Successfully recorded a new event occurrence.");

        return redirect(route('events.show',$event_id));
    }

    public function signup(Request $request, int $occurrence_id)
    {
        $occurrence = EventOccurrence::query()->where('id','=',$occurrence_id)->get()->first();

        if(is_null($occurrence->id))
            return abort(404);

        $existing_signup = EventSignup::query()->where('event_occurrence_id','=',$occurrence_id)
        ->where("user_id",'=',Auth::id())
        ->get()
        ->first();

        if(!is_null($existing_signup)) {
            $existing_signup->delete();

            return response()->json([
                "is_signed_up" => false
            ]);
        }

        $signup = new EventSignup();

        $signup->event_occurrence_id = $occurrence->id;
        $signup->user_id = Auth::id();

        $signup->save();

        return response()->json([
            "is_signed_up" => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventOccurrence  $eventOccurrence
     * @return \Illuminate\Http\Response
     */
    public function show(EventOccurrence $eventOccurrence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventOccurrence  $eventOccurrence
     * @return \Illuminate\Http\Response
     */
    public function edit(EventOccurrence $eventOccurrence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventOccurrence  $eventOccurrence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventOccurrence $eventOccurrence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventOccurrence  $eventOccurrence
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventOccurrence $eventOccurrence)
    {
        //
    }
}
