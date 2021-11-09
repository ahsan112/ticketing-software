<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketTaskController extends Controller
{
    public function create(Ticket $ticket)
    {
        return view('tickets.tasks.create', [
            'ticket' => $ticket->id,
            'users' => User::all()
        ]);
    }

    public function store(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'target_date' => 'required|date',
            'owner_id' => 'required|exists:users,id'
        ]);

        $ticket->tasks()->create($validated);

        return redirect()->route('tickets.show', $ticket);
    }
}
