<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketDocument;
use Illuminate\Http\Request;

class TicketDocumentController extends Controller
{
    public function create(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'title' => 'required',
            'file' => 'required|file'
        ]);

        $validated['created_by_id'] = $request->user()->id;
        $validated['file'] = $request->file('file')->store('ticket_documents');

        $ticket->documents()->create($validated);

        return redirect()->route('tickets.show', $ticket);
    }

    public function download(TicketDocument $document)
    {
        $path = storage_path() . '/app/' . $document->file;
        
        return response()->download($path);
    }
}
