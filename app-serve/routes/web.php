<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');

Route::post('/contact', 'HomeController@contact')->name('contact.index');

Route::get('/histories', 'HomeController@histories')->name('histories.index');

Route::get('/histories/search/{search}', 'HomeController@search')->name('histories.search');

Route::get('/histories/{history}', 'HomeController@history')->name('histories.show');

Route::view('about', 'about')->name('about');

Route::view('contacts', 'contacts')->name('contacts');

Auth::routes();

Route::middleware(['auth', 'admin'])->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

	Route::get('/', 'HomeController@index')->name('index');

    Route::get('/account/profile', 'AccountController@profile')->name('account.profile');

    Route::patch('/account/profile/{user}', 'AccountController@update')->name('account.profile.update');

    Route::resource('users', 'UserController');

    Route::resource('categories', 'CategoryController');

    Route::get('admin/users/{user}/delete', 'UserController@destroy')->name('users.delete');


    Route::post('histories/change/status/{history}', 'HistoriesController@changeStatus');
    Route::post('histories/update/{history}', 'HistoriesController@update');
    Route::resource('histories', 'HistoriesController');

    Route::get('histories/tests/{history}/create', 'TestController@create')->name('tests.create');
    Route::post('histories/tests/{history}/store', 'TestController@store')->name('tests.store');


    Route::get('histories/memories/{history}/create', 'MemoryController@create')->name('memories.create');
    Route::post('histories/memories/{history}/store', 'MemoryController@store')->name('memories.store');
    Route::delete('histories/memories/{memory}/delete', 'MemoryController@destroy')->name('memories.delete');

    Route::get('histories/letter_soups/{history}/create', 'LetterSoupController@create')->name('letter_soups.create');
    Route::post('histories/letter_soups/{history}/store', 'LetterSoupController@store')->name('letter_soups.store');
    Route::put('histories/letter_soups/{letter_soup}/update', 'LetterSoupController@update')->name('letter_soups.update');

    Route::post('categories/update/{category}', 'CategoryController@update');
    Route::resource('categories', 'CategoryController');

    Route::get('statistics', 'StatisticsController@index')->name('statistics.index');

    Route::get('/histories/{history}/preview', 'HistoriesController@preview')->name('histories.preview');

});


Route::middleware(['auth'])->group(function () {

    Route::get('histories/play/{history}/puzzles', 'HistoriesController@puzzles')->name('play.puzzles');
    Route::get('histories/play/{history}/letter_soup', 'HistoriesController@letter_soup')->name('play.letter_soup');
    Route::get('histories/play/{history}/memores', 'HistoriesController@memores')->name('play.memores');
    Route::get('histories/play/{history}/video', 'HistoriesController@video')->name('play.video');

    Route::post('points', 'PointController@store')->name('points.store');

    Route::post('avatar', 'AccountController@updateAvatar')->name('updateAvatar');

});


Route::middleware(['auth', 'user'])->prefix('dashboard')->name('dashboard.')->group(function () {

    Route::get('/', 'HomeController@index')->name('index');

    Route::get('/account/profile', 'AccountController@profile')->name('account.profile');

    Route::patch('/account/profile/{user}', 'AccountController@update')->name('account.profile.update');




});



//GET,  POST,   PUSH,     DELETE
//LEER, CREAR, EDITAR, ELIMINAR
