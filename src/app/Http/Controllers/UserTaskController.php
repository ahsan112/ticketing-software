<?php

namespace App\Http\Controllers;

class UserTaskController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('tickets.tasks.index', [
            'tasks' => auth()->user()->tasks()
        ]);
    }
}
