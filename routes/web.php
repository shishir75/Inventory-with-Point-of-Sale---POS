<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get( '/{any}', function () {
    return view( 'welcome', ['auth_user' => Auth::user()] );
} )->where( 'any', '.*' );
