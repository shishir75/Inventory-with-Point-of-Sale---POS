<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware( 'JWT', ['except' => ['login', 'signup']] );
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request( ['email', 'password'] );

        if ( !$token = Auth::attempt( $credentials ) ) {
            return response()->json( ['error' => 'Email or Password is Incorrect'], 401 );
        }

        return $this->respondWithToken( $token );
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json( auth()->user() );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json( ['message' => 'Successfully logged out'] );
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken( Auth::refresh() );
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken( $token )
    {
        return response()->json( [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Auth::factory()->getTTL() * 60,
        ] );
    }

    public function signup( Request $request )
    {
        $validateData = $request->validate( [
            'name'     => 'required',
            'email'    => 'required | email |max:255 |unique:users',
            'password' => 'required |min:8 |confirmed',
        ] );

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make( $request->password );
        $user->save();

        return $this->login( $request );
    }
}
