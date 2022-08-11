<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;

class EventController extends Controller
{
    protected $middleware = [

    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            "events.index",
            ["open_events" => Event::query()->where("is_signup_open","=",true)->get()]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("events.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $event = new Event();

        $event->fill([
            'player_limit' => $request->get('player_limit'),
            'scheduled_date' => $request->get('scheduled_date'),
            'event_title' => $request->get('event_title'),
            'is_signup_open' => true,
            'item_level' => $request->get('item_level'),
        ]);

        $event->event_type = "vykas";

        $event->save();

        session()->flash("status","Successfully recorded a new events.");

        return redirect(route('events.show',$event));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', ["event" => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', ["event" => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event = new Event();

        $event->fill([
            'player_limit' => $request->get('player_limit'),
            'scheduled_date' => $request->get('scheduled_date'),
            'event_title' => $request->get('event_title'),
            'is_signup_open' => true,
            'item_level' => $request->get('item_level'),
        ]);

        $event->event_type = "vykas";

        $event->save();

        session()->flash("status","Successfully edited this events.");

        return redirect(route("events.show",$event));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
