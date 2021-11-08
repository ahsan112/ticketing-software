<?php

namespace App\View\Components;

use App\Models\TicketStatus;
use Illuminate\View\Component;

class TicketStatusSelect extends Component
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
        return view('components.ticket-status-select', [
            'statuses' => TicketStatus::all()
        ]);
    }
}
