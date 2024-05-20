<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VerifyPhoneController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'code'  => 'required|numeric'
        ]);

        if ($request->user()->hasVerifiedPhone()) {
            return redirect()->intended(
                route('eatery.index')
            );
        }

        ($request->code == $request->user()->phone_verfiy_code) ?
            $request->user()->markPhoneAsVerified() :
            throw ValidationException::withMessages([
                'code' => ['The provided credentials are incorrect.']
            ]);

        return redirect()->intended(
            route('eatery.index')
        );
    }
}
