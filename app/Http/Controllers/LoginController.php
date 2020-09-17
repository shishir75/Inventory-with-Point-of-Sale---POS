<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login( Request $request )
    {
        $request->validate( [
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ] );

        if ( Auth::attempt( ['email' => $request->email, 'password' => $request->password] ) ) {
            return response()->json( Auth::user(), 200 );
        } else {
            throw ValidationException::withMessages( [
                'email' => ['The Provided Credentials are Incorrect'],
            ] );
        }

    }

    public function logout()
    {
        Auth::logout();
    }
}
