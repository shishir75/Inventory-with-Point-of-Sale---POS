<?php

use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'welcome' );
} )->name( 'root' );

Route::get( '/{vue_captute?}', function () {
    return view( 'welcome' );
} )->where( 'vue_captute', '[\/\w\.-]*' );
