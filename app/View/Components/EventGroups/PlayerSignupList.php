<?php

namespace App\View\Components\EventGroups;

use App\Models\EventSignup;
use Illuminate\View\Component;

class PlayerSignupList extends Component
{
    private EventSignup $signup;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(EventSignup $signup)
    {
        $this->signup = $signup;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.event-groups.player-signup-list', [
            'signup' => $this->signup
        ]);
    }
}
