<?php

    use App\Http\Controllers\clients\MesureController;
    use Illuminate\Support\Facades\Route;

    Route::middleware ('auth')->group (function () {
        Route::name ('client.mesure.')->group (function () {
            Route::controller (MesureController::class)->group (function () {
                Route::get ('/client/mesure/list', 'home')->name ('list');
                Route::get ('/client/mesure/add/{id}', 'add')->name ('add');
                Route::post ('/client/mesure/store', 'store')->name ('store');
                Route::get ('/client/{client}/mesure/edit/{id}', 'edit')->name ('edit');
                Route::post ('/client/mesure/update', 'update')->name ('update');
                Route::get ('/client/mesure/delete/{id}', 'delete')->name ('delete');
                Route::get ('/client/mesure/print/{id}', 'print')->name ('print');
                Route::get ('/client/{client}/mesure/view/{id}', 'view')->name ('view');
            });
        });
    });

