<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    private string $m_id;
    private string $m_label;
    private string $m_type;
    private ?string $m_value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $property,string $label,string $value = null,string $type = "text")
    {
        $this->m_id = $property;
        $this->m_label = $label;
        $this->m_type = $type;
        $this->m_value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input',[
                "id" => $this->m_id,
                "type" => $this->m_type,
                "label" => $this->m_label,
                "value" => $this->m_value
            ]
        );
    }
}
