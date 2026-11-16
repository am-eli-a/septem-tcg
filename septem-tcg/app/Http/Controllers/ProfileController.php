<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //
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
        $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
