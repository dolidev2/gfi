<?php


use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AgenceController;

Route::middleware ('auth')->group (function () {
    Route::name ('agences.')->group (function () {
        Route::controller (AgenceController::class)->group (function () {
            Route::get ('/agences/list', 'home')->name ('list');
            Route::get ('/agences/add', 'add')->name ('add');
            Route::post ('/agences/store', 'store')->name ('store');
            Route::get ('/agences/edit/{id}', 'edit')->name ('edit');
            Route::post ('/agences/update', 'update')->name ('update');
            Route::get ('/agences/delete/{id}', 'delete')->name ('delete');
        });
    });
});
