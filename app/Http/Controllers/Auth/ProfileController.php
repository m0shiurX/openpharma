<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Profile/Index', [
            'user'  => AuthResource::make($request->user())->toArray($request)
        ]);
    }


    public function create(Request $request)
    {
        return Inertia::render('Profile/Edit', [
            'user'  => AuthResource::make($request->user())->toArray($request)
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
