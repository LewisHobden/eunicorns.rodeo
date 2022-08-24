<?php

namespace App\Http\Livewire\EventGroups;

use App\Models\EventGroup;
use App\Models\EventOccurrence;
use Livewire\Component;

class GroupList extends Component
{
    public iterable $groups;
    public EventOccurrence $occurrence;

    protected $listeners = ['updateGroups' => 'mount'];

    public function mount()
    {
        $this->groups = EventGroup::query()->where("event_occurrence_id", "=", $this->occurrence->id)->get();
    }

    public function render()
    {
        return view('livewire.event-groups.group-list');
    }
}
