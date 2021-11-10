<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tickets.index', [
            'tickets' => Ticket::withOutRejected()->with('status', 'priority', 'department')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        $validated['updated_by_id'] = $request->user()->id;

        $request->user()->tickets()->create($validated);

        return redirect()->route('tickets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $ticket->load('type', 'status', 'priority', 'department', 'comments', 'documents', 'tasks');

        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {   
        $this->authorize('update', $ticket);
        
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'department_id' => 'nullable|exists:departments,id',
            'priority_id' => 'nullable|exists:ticket_priorities,id',
            'status_id' => 'nullable|exists:ticket_statuses,id',
            'owner_id' => 'nullable|exists:users,id',
            'target_date' => 'nullable|date',
        ]);

        $validated['updated_by_id'] = $request->user()->id;

        $ticket->update($validated);

        return redirect()->route('tickets.show', $ticket);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
