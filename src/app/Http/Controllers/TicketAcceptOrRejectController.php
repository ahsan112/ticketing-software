<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketAcceptOrRejectController extends Controller
{
    public function __construct()
    {
        $this->authorize('manage-ticket');
    }

    public function accept(Ticket $ticket)
    {
        $ticket->accept();

        return redirect()->route('tickets.show', $ticket);
    }

    public function reject(Ticket $ticket)
    {
        $ticket->reject();

        return redirect()->route('tickets.show', $ticket);
    }
}
