<?php

namespace App\Http\Controllers;

use App\Models\TicketTask;
use Illuminate\Http\Request;

class TicketTaskCommentController extends Controller
{
    public function create(Request $request, TicketTask $task)
    {
        $validated = $request->validate([
            'body' => 'required'
        ]);

        $validated['created_by_id'] = $request->user()->id;

        $task->comments()->create($validated);

        return redirect()->route('ticket.tasks.edit', $task);
    }
}
