<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserProfille;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return inertia('Public/Register');
    }

     public function store(Request $request)
    {
        $validated = $request->validate([
            "profile"  => ["required", Rule::enum(UserProfille::class)],
            "email"    => ["required", "email", Rule::unique('users')],
            "password" => ["required", "min:6"],
        ]);

        $user = User::create($validated);

        Auth::login($user);

        return redirect("/")->with("message", "Your profile has been created successfully.");
    }

    public function edit(User $user)
    {
        return inertia("Users/Edit", [
            "user" => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = ($request->validate([
            'profile'          => ['required', Rule::enum(UserProfille::class)],
            'email'            => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['required', 'current_password'],
            'password'         => ['sometimes', 'min:6']
        ]));

        $user->update(Arr::except($validated, 'current_password'));

        return redirect("/")->with("message", "Your profile has been updated successfully.");
    }

    public function destroy(User $user)
    {
        Auth::logout();

        $user->delete();

        return redirect("login")->with("message", "Your profile has been deleted successfully.");
    }
}
