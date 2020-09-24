<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware( 'auth:sanctum' )->get( '/user', function ( Request $request ) {
    return $request->user();
} );

Route::middleware( 'auth:sanctum' )->get( '/authenticated', function () {
    return true;
} );

Route::post( '/register-account', 'RegisterController@register' );
Route::post( '/login', 'LoginController@login' );
Route::post( '/logout', 'LoginController@logout' );

Route::group( ['namespace' => 'Admin', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResources( [
        '/employee' => 'EmployeeController',
        '/supplier' => 'SupplierController',
        '/category' => 'CategoryController',
        '/product'  => 'ProductController',
        '/expense'  => 'ExpenseController',
        '/salary'   => 'SalaryController',
        '/customer' => 'CustomerController',
    ] );
    Route::get( '/salary/{month_year}/monthly', "SalaryController@month_year" );
    Route::put( '/product/stock/{id}', "ProductController@update_stock" );
    Route::get( '/category/{category}/product', "PosController@category_product" );
} );
