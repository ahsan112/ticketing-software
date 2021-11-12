<?php

namespace App\Observers;

use App\Models\TicketDocument;

class TicketDocumentObserver
{
    /**
     * Handle the TicketDocument "created" event.
     *
     * @param  \App\Models\TicketDocument  $ticketDocument
     * @return void
     */
    public function created(TicketDocument $ticketDocument)
    {
        $ticketDocument->activity()->create([
            'ticket_id' => $ticketDocument->ticket->id,
            'user_id' => auth()->user()->id,
            'description' => 'uploaded'
        ]);
    }
}
