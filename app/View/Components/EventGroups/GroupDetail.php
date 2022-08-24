<?php

namespace App\View\Components\EventGroups;

use App\Models\Event;
use Illuminate\View\Component;

class GroupDetail extends Component
{
    private Event $event;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.event-groups.group-detail', ['event' => $this->event]);
    }
}
