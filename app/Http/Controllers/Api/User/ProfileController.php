<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $user = request()->user();

        return new ProfileResource(
            $user->load('image', 'location')
        );
    }

    public function destroy(User $user)
    {
        $user = request()->user();

        $user->delete();

        auth()->logout();

        return response()->noContent();
    }
}
