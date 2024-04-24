<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return view('user.profile', [
            'user' => $request->user()
        ]);
    }

    public function edit(Request $request)
    {
        return view('user.profile-edit', [
            'user' => $request->user()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'max:100'],
            'username' => ['required', 'unique:users,username,' . $request->user()->id],
            'password_baru' => ['nullable', 'max:100', 'confirmed']
        ]);

        $user = $request->user();

        if ($request->filled('password_baru')) {
            $user->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password_baru),
            ]);
        } else {
            $user->update($request->only('nama', 'username'));
        }

        return redirect()->route('profile.show')->with('update', 'success');
    }
}
