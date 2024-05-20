<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Events\Registered;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username'      => ['required', 'string', 'max:100'],
            'phone'         => ['required', 'numeric', 'min:14', 'unique:users,phone_number'],
            // 'password'   => ['required', 'confirmed', Rules\Password::defaults()],
            'password'      => ['required', 'string', 'min:5'],
            'image'         => ['required', 'image'],
            'latitude'      => ['required'],
            'longitude'     => ['required'],
        ]);

        $user = User::create([
            'username'          => $request->username,
            'phone'             => $request->phone,
            'password'          => Hash::make($request->password),
            'phone_verfiy_code' => rand(11111, 99999)
        ]);

        $user->location()->create([
            'latitude'  => request()->latitude,
            'longitude' => request()->longitude
        ]);

        if ($request->hasFile('image')) {
            $user->image()->create([
                'path'   => $request->file('image')->store('users/thumbile')
            ]);
        }

        // event(new Registered($user));

        $token = auth()->login($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60 * 60
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
