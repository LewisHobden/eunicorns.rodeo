<?php

namespace App\View\Components;

use App\Enum\CharacterClassEnum;
use Illuminate\View\Component;

class ClassIcon extends Component
{
    private CharacterClassEnum $class;
    private string $modifier;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CharacterClassEnum $class, string $modifier = "")
    {
        $this->class = $class;
        $this->modifier = $modifier;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.class-icon', [
            "class" => $this->class,
            "modifier" => $this->modifier ?? "default"
        ]);
    }
}
