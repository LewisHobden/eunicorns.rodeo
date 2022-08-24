<?php

namespace App\Http\Livewire\EventGroups;

use App\Models\Character;
use App\Models\EventGroup;
use App\Models\EventGroupMember;
use App\Models\EventOccurrence;
use Livewire\Component;

class GroupAssignment extends Component
{
    public EventOccurrence $occurrence;
    public Character       $character;
    public iterable        $groups;
    public ?EventGroup      $existing_group = null;

    public function remove(EventGroup $group)
    {
        EventGroupMember::query()->where('character_id', '=', $this->character->id)
            ->where('event_group_id', '=', $group->id)
            ->delete();

        $this->emit('updateGroups');
    }


    public function signup(EventGroup $group)
    {
        $occupied_character = $this->character->user->getOccupiedCharacter($group->occurrence);

        if (null !== $occupied_character) {
            session()->flash('error', "{$occupied_character->in_game_name} is occupied at this time.");

            return;
        }

        $member = new EventGroupMember();
        $member->forceFill([
            'event_group_id' => $group->id,
            'character_id' => $this->character->id,
        ]);

        $member->save();

        $this->emit('updateGroups');
    }

    public function mount()
    {
        $this->groups = EventGroup::query()->where("event_occurrence_id", "=", $this->occurrence->id)->get();

        foreach ($this->groups as $group) {
            if ($this->character->isInGroup($group)) {
                $this->existing_group = $group;
            }
        }
    }

    public function render()
    {
        return view('livewire.event-groups.group-assignment');
    }
}
