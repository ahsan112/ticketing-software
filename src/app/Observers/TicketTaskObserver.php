<?php

namespace App\Observers;

use App\Mail\TicketTaskAssigned;
use App\Mail\TicketTaskComplete;
use App\Models\TicketTask;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TicketTaskObserver
{
    /**
     * Handle the TicketTask "created" event.
     *
     * @param  \App\Models\TicketTask  $ticketTask
     * @return void
     */
    public function created(TicketTask $ticketTask)
    {   
        $user = User::findOrFail($ticketTask->owner_id);

        Mail::to($user->email)->queue(new TicketTaskAssigned($ticketTask));
    }

    /**
     * Handle the TicketTask "updated" event.
     *
     * @param  \App\Models\TicketTask  $ticketTask
     * @return void
     */
    public function updated(TicketTask $ticketTask)
    {
        if ($ticketTask->isDirty('completed')) {

            $user = User::findOrFail($ticketTask->owner_id);

            Mail::to($user->email)->queue(new TicketTaskComplete($ticketTask));
        }
    }

    /**
     * Handle the TicketTask "deleted" event.
     *
     * @param  \App\Models\TicketTask  $ticketTask
     * @return void
     */
    public function deleted(TicketTask $ticketTask)
    {
        //
    }

    /**
     * Handle the TicketTask "restored" event.
     *
     * @param  \App\Models\TicketTask  $ticketTask
     * @return void
     */
    public function restored(TicketTask $ticketTask)
    {
        //
    }

    /**
     * Handle the TicketTask "force deleted" event.
     *
     * @param  \App\Models\TicketTask  $ticketTask
     * @return void
     */
    public function forceDeleted(TicketTask $ticketTask)
    {
        //
    }
}
