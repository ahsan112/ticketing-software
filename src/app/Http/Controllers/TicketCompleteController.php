<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketCompleteController extends Controller
{
    public function __invoke(Ticket $ticket)
    {
        $this->authorize('manage-ticket');

        $ticket->complete();      
        
        return redirect()->route('tickets.show', $ticket);
    }
}
