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
    public function assign(Request $request, EventOccurrence $occurrence)
    {
        $allocated_groups = $request->get("groups");

        foreach ($allocated_groups as $group) {
            // Assert all data is valid and correct. Bin the rest.
            $event_group = EventGroup::query()->where("id","=",$group['group']['group_id'])->get()->first();
            EventGroupMember::query()->where("event_group_id","=",$event_group->id)->delete();

            foreach ($group['signups'] as $signup) {
                $member = new EventGroupMember();
                $member->event_group_id = $event_group->id;
                $member->character_id = $signup['character_id'];

                $member->save();
            }
        }

        return response()->json(["success" => true]);
    }

    public function index(EventOccurrence $occurrence)
    {
        $groups = EventGroup::query()->where("event_occurrence_id", "=", $occurrence->id)->get();

        return view('events.occurrences.event-groups.index', [
            "signups" => $occurrence->signups,
            "occurrence" => $occurrence,
            "groups" => $groups->map(
                fn(EventGroup $group) => [
                    "group" => ["group_name" => $group->group_name, "group_id" => $group->id],
                    "signups" => null === $group->members ? null : $group->members->map(
                        fn(EventGroupMember $member) => SignupModel::fromCharacter($member->character)
                    ),
                ]
            ),
            "players" => $occurrence->signups->map(
                fn(EventSignup $signup) => [
                    "user" => ["name" => $signup->user->name],
                    "characters" => SignupModel::fromCharacters(
                        $signup->user->charactersNotInEvent($occurrence)
                    ),
                ]
            ),
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
