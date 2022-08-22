<?php

namespace App\Http\Livewire\EventGroups;

use App\Models\Character;
use App\Models\EventGroupMember;
use Livewire\Component;

class GroupAssignment extends Component
{
    public iterable $groups;
    public Character $character;

    public function signup(int $group_id)
    {
        $member = new EventGroupMember();
        $member->forceFill([
            'event_group_id' => $group_id,
            'character_id' => $this->character->id
        ]);

        $member->save();
    }

    public function render()
    {
        return view('livewire.event-groups.group-assignment');
    }
}
