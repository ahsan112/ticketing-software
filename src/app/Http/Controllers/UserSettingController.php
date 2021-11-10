<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as PasswordRule;

class UserSettingController extends Controller
{
    public function index()
    {
        return view('settings', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request, User $user)
    {

        $validate = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($validate);

        return redirect()->route('dashboard');
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('dashboard');        
    }
}
