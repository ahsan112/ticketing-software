<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketApproval;
use Illuminate\Http\Request;

class TicketApprovalController extends Controller
{
    public function create(Request $request, Ticket $ticket)
    {
        $this->authorize('create-approver');

        $validated = $request->validate([
            'owner_id' => 'required|exists:users,id',
        ]);

        $ticket->approvers()->create($validated);

        return redirect()->route('tickets.show', $ticket);
    }

    public function approve(TicketApproval $approver)
    {
        $this->authorize('approve', $approver);
        
        $approver->approve();

        return redirect()->route('tickets.show', $approver->ticket_id);
    }
}
