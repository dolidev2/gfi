<?php

    use App\Http\Controllers\clients\ClientController;
    use Illuminate\Support\Facades\Route;

    Route::middleware ('auth')->group (function () {
    Route::name ('clients.')->group (function () {
        Route::controller (ClientController::class)->group (function () {
            Route::get ('/clients/list', 'home')->name ('list');
            Route::get ('/clients/add', 'add')->name ('add');
            Route::post ('/clients/store', 'store')->name ('store');
            Route::get ('/clients/edit/{id}', 'edit')->name ('edit');
            Route::post ('/clients/update', 'update')->name ('update');
            Route::get ('/clients/delete/{id}', 'delete')->name ('delete');
            Route::get ('/clients/view/{id}', 'view')->name ('view');
            Route::get ('/clients/statistique/{id}', 'statistique')->name ('statistique');
            Route::get ('/clients/recommandation/{id}', 'recommandation')->name ('recommandation');
        });
    });
});

