<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventGroupRequest;
use App\Http\Requests\UpdateEventGroupRequest;
use App\Models\EventGroup;
use App\Models\EventGroupMember;
use App\Models\EventOccurrence;
use App\Models\EventSignup;
use App\Models\SignupModel;
use Symfony\Component\HttpFoundation\Request;

class EventGroupController extends Controller
{
    public function index(EventOccurrence $occurrence)
    {
        return view('events.occurrences.event-groups.index', [
            "signups" => $occurrence->signups,
            "occurrence" => $occurrence,
            "groups" => EventGroup::query()->where("event_occurrence_id", "=", $occurrence->id)->get(),
            "players" => $occurrence->signups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(EventOccurrence $occurrence)
    {
        return view('events.occurrences.event-groups.create', [
            "occurrence" => $occurrence,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreEventGroupRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventGroupRequest $request, EventOccurrence $occurrence)
    {
        $group = new EventGroup();
        $group->forceFill([
            "event_occurrence_id" => $occurrence->id,
            "group_name" => $request->get("group_name"),
        ]);

        $group->save();

        session()->flash("Your raid group has been created successfully.");

        return redirect(route('occurrences.groups.index', $occurrence));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\EventGroup $eventGroup
     * @return \Illuminate\Http\Response
     */
    public function show(EventGroup $eventGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EventGroup $eventGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(EventGroup $eventGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateEventGroupRequest $request
     * @param \App\Models\EventGroup $eventGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventGroupRequest $request, EventGroup $eventGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EventGroup $eventGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventGroup $eventGroup)
    {
        //
    }
}
