<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketFilterController extends Controller
{
    
    public function __invoke(Request $request)
    {
        return view('tickets.index', [
            'tickets' => Ticket::latest()
                    ->with('status', 'priority', 'department')
                    ->filter(request(['view', 'owner_id']))
                    ->get(),
            'view' => $request->view,
            'user' => $request->owner_id
        ]);
    }
}
