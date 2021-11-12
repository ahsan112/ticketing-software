<?php

namespace App\Observers;

use App\Mail\DeveloperAssignedTicket;
use App\Mail\NewTicketRaised;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function created(Ticket $ticket)
    {
        $managers = User::where('role', 'manager')->pluck('email')->toArray();

        Mail::to($managers)->queue(new NewTicketRaised($ticket));
    }


    /**
     * handle before updated
     *
     * @param Ticket $ticket
     * @return void
     */
    public function updating(Ticket $ticket)
    {
        $ticket->old = $ticket->getOriginal();
    }

    /**
     * Handle the Ticket "updated" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function updated(Ticket $ticket)
    {
        if($ticket->isDirty('owner_id')) {
            $user = User::findOrFail($ticket->owner_id);

            Mail::to($user->email)->queue(new DeveloperAssignedTicket($ticket));
        }

        $ticket->activity()->create([
            'user_id' => auth()->user()->id,
            'description' => 'updated',
            'changes' => $this->activityChanges($ticket)
        ]);
    }

    private function activityChanges(Ticket $ticket)
    {
        return [
            'before' => Arr::except(array_diff($ticket->old, $ticket->getAttributes()), 'updated_at'),
            'after' => Arr::except($ticket->getChanges(), 'updated_at')
        ];
    }
}
