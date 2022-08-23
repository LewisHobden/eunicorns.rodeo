<?php

namespace App\Http\Livewire\EventGroups;

use App\Models\Character;
use App\Models\EventGroup;
use App\Models\EventGroupMember;
use Livewire\Component;

class GroupAssignment extends Component
{
    public iterable  $groups;
    public Character $character;

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
    }

    public function render()
    {
        return view('livewire.event-groups.group-assignment');
    }
}
