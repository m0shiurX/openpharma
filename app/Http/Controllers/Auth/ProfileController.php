<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('Profile/Index', [
            'user'  => [
                'id'    => auth()->id(),
                'name'  => auth()->user()->name,
                'email'  => auth()->user()->email,
                'photo'  => auth()->user()->photo_path ? URL::route('image', [
                    'path' => auth()->user()->photo_path,
                    'w' => 96,
                    'h' => 96,
                    'fit' => 'cover'
                ]) : null,
                'deleted_at'  => auth()->user()->deleted_at,
            ],
        ]);
    }


    public function create()
    {
        return Inertia::render('Profile/Edit', [
            'user'  => [
                'id'    => auth()->id(),
                'name'  => auth()->user()->name,
                'email'  => auth()->user()->email,
                'photo'  => auth()->user()->photo_path ? URL::route('image', ['path' => auth()->user()->photo_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
                'deleted_at'  => auth()->user()->deleted_at,
            ],
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->update($request->only('name', 'email'));

        if ($request->hasFile('photo')) {
            $request->user()->update(['photo_path' => $request->photo->store('users')]);
        }

        if ($request->get('password')) {
            $request->user()->update(['password' => Hash::make($request->password)]);
        }
        return Redirect::back()->with('success', 'User updated.');
    }
}
