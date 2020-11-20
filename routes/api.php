<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Customer;

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

// CUSTOMER ROUTE
Route::group(['prefix' => 'customer/v1'], function () {
    Route::post('auth/login', 'API\CustomerAuthController@login');
    Route::post('auth/register', 'API\CustomerAuthController@register');
    Route::get('auth/verify/{id}', 'API\CustomerAuthController@verify');

    Route::group(['middleware' => ['auth:customer-api']], function () {
        Route::get('auth/logout', 'API\CustomerAuthController@logout');
        Route::get('auth/details', 'API\CustomerAuthController@details');
    });
});

// MITRA ROUTE
Route::group(['prefix' => 'mitra/v1'], function () {
    Route::post('auth/login', 'API\MitraAuthController@login');
    Route::post('auth/register', 'API\MitraAuthController@register');
    Route::get('auth/verify/{id}', 'API\MitraAuthController@verify');

    Route::group(['middleware' => ['auth:mitra-api']], function () {
        Route::get('auth/logout', 'API\MitraAuthController@logout');
        Route::get('auth/details', 'API\MitraAuthController@details');
    });
});


// ADMIN ROUTE
Route::group(['prefix' => 'v1'], function () {
    Route::get('customers/{id?}', function ($id = null) {
        if ($id == null) {
            return Customer::get();
        }
    });

    Route::get('mitras/{id?}', function ($id = null) {
        if ($id == null) {
            return Mitra::get();
        }
    });
});


