<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use App\Http\Resources\AuthResource;

class HandleInertiaRequests extends Middleware
{

    protected $rootView = 'app';

    public function version(Request $request): string | null
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user() ? AuthResource::make($request->user())->toArray($request) : $request->user(),
                'role' => $request->user()?->getRoleNames(),
            ],
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
        ]);
    }
}
