<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'welcome', ['auth_user' => Auth::user()] );
} )->name( 'root' );

Route::get( '/{vue_capture?}', function () {
    return view( 'welcome', ['auth_user' => Auth::user()] );
} )->where( 'vue_capture', '[\/\w\.-]*' );
