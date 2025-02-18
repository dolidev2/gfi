<?php

    use App\Http\Controllers\clients\RemarqueController;
    use Illuminate\Support\Facades\Route;

    Route::middleware ('auth')->group (function () {
        Route::name ('client.remarque.')->group (function () {
            Route::controller (RemarqueController::class)->group (function () {
                Route::get ('/client/remarque/list', 'home')->name ('list');
                Route::post ('/client/remarque/store', 'store')->name ('store');
                Route::post ('/client/remarque/update', 'update')->name ('update');
                Route::get ('/client/remarque/delete/{id}', 'delete')->name ('delete');
                Route::get ('/client/remarque/view/{id}', 'view')->name ('view');
                Route::get ('/client/remarque/print/{id}', 'print')->name ('print');
            });
        });
    });

