<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show() {
        $user = auth()->user();
        return view('profil-view', ['next' => $user->nextBoosterAt(), 'user' => $user]);
    }

    public function edit() {
        return view('profil-edit', ['user' => auth()->user()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $pseudo_unique = Rule::unique('users', 'name')->ignore(auth()->user()->id);
        $email_unique = Rule::unique('users', 'email')->ignore(auth()->user()->id);

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:50', $pseudo_unique],
            'email' => ['required', 'email', $email_unique],
        ]);

        $request->user()->update($validated);
        return back()->with('status', 'Profil mis à jour !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
        $request->user()->update(['password' => $validated['password']]);
        return back()->with('status', 'Mot de passe mis à jour !');
    }
}
