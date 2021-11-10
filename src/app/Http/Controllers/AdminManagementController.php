<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminManagementController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::all()
        ]);
    }

    public function edit(User $user)
    {
        return view('settings', compact('user'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:users,role'
        ]);

        $user->update([
            'role' => $request->role
        ]);

        return redirect()->route('users.index');        
    }
}
