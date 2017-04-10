<?php

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

Route::group(['middleware' => 'auth:api'], function () {

    Route::resource('users', 'UserController', ['except' => [
        'create', 'edit'
    ]]);

    Route::resource('notes', 'NoteController', ['except' => [
        'create', 'edit'
    ]]);
});
