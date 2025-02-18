<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    Route::name('users.')->group(function () {
        Route::controller(UserController::class)->group(function () {

            Route::get('/users/list', 'home')->name('list');
            Route::get('/users/add', 'add')->name('add');
            Route::post('/users/store', 'store')->name('store');
            Route::get('/users/edit/{id}', 'edit')->name('edit');
            Route::post('/users/update', 'update')->name('update');
            Route::post('/users/updatePassword', 'updatePassword')->name('update_password');
            Route::get('/users/delete/{id}', 'delete')->name('delete');

        });
    });
});
