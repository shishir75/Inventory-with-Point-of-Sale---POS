<?php

use Illuminate\Support\Facades\Route;

Route::group( ['middleware' => 'api', 'prefix' => 'auth'], function ( $router ) {

    Route::post( 'login', 'AuthController@login' );
    Route::post( 'signup', 'AuthController@signup' );
    Route::post( 'logout', 'AuthController@logout' );
    Route::post( 'refresh', 'AuthController@refresh' );
    Route::post( 'me', 'AuthController@me' );

} );
