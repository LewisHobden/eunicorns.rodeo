<?php

namespace App\Http\Livewire\EventGroups;

use App\Models\EventOccurrence;
use Livewire\Component;

class PlayerList extends Component
{
    public iterable        $players;
    public EventOccurrence $occurrence;

    protected $listeners = ['updateGroups' => 'mount'];

    public function mount()
    {
        $this->players = $this->occurrence->signups;
    }

    public function render()
    {
        return view('livewire.event-groups.player-list');
    }
}
