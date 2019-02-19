<?php

use Illuminate\Http\Request;

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

Route::namespace('Api')->prefix('admin')->name('admin.')->group(function () {

    Route::resource('histories', 'HistoriesController');

    Route::resource('categories', 'CategoryController');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
