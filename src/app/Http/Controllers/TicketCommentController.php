<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketCommentController extends Controller
{
    public function create(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'body' => 'required'
        ]);

        $validated['created_by_id'] = $request->user()->id;

        $ticket->comments()->create($validated);

        return redirect()->route('tickets.show', $ticket);
    }
}
