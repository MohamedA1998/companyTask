<?php

namespace App\Http\Controllers\Api\Delivery\Auth;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class DeliveryAuthenticatedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:delivery')->only('destroy');
    }


    public function store(Request $request)
    {
        $request->validate([
            'phone'     => 'required|numeric|min:14',
            'password'  => 'required|string'
        ]);

        $delivery = Delivery::where('phone', $request->phone)->first();

        if (!$delivery) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.']
            ]);
        }

        if (!Hash::check($request->password, $delivery->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided credentials are incorrect.']
            ]);
        }

        $credentials = $request->only('phone', 'password');

        if (!$token = auth()->guard('delivery')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60 * 60 * 24
        ]);
    }


    public function destroy(Request $request)
    {
        auth()->guard('delivery')->logout();

        return response()->noContent();
    }
}
