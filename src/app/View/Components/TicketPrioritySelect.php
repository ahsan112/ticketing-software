<?php

namespace App\View\Components;

use App\Models\TicketPriority;
use Illuminate\View\Component;

class TicketPrioritySelect extends Component
{
    public $selected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?String $selected = '')
    {
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ticket-priority-select', [
            'priorities' => TicketPriority::all()
        ]);
    }
}
