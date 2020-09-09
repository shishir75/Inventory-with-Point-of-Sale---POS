<?php

use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'welcome' );
} )->name( 'root' );

Route::get( '/{vue_capture?}', function () {
    return view( 'welcome' );
} )->where( 'vue_capture', '[\/\w\.-]*' );
