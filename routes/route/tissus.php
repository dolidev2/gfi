<?php

    use App\Http\Controllers\clients\TissuController;
    use Illuminate\Support\Facades\Route;

    Route::middleware ('auth')->group (function () {
        Route::name ('client.tissu.')->group (function () {
            Route::controller (TissuController::class)->group (function () {
                Route::get ('/client/{client}/tissu/view/{id}', 'view')->name ('view');
                Route::get ('/client/tissu/add/{id}', 'add')->name ('add');
                Route::post ('/client/tissu/store', 'store')->name ('store');
                Route::get ('/client/{client}/tissu/edit/{id}', 'edit')->name ('edit');
                Route::get ('/client/tissus/{client}', 'viewClientTissu')->name ('viewClientTissu');
                Route::post ('/client/tissu/update', 'update')->name ('update');
                Route::get ('/client/tissu/delete/{id}', 'delete')->name ('delete');
                Route::get ('/client/{client}/tissu/detail/{id}', 'view')->name ('view');
            });
        });
    });

