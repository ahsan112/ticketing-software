<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketAcceptOrRejectController extends Controller
{    
    public function accept(Ticket $ticket)
    {
        $this->authorize('manage-ticket');

        $ticket->accept();

        return redirect()->route('tickets.show', $ticket);
    }

    public function reject(Ticket $ticket)
    {
        $this->authorize('manage-ticket');

        $ticket->reject();

        return redirect()->route('tickets.show', $ticket);
    }
}
