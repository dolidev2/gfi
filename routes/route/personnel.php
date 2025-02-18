<?php

    use App\Http\Controllers\personnels\PersonnelController;
    use Illuminate\Support\Facades\Route;

    Route::middleware ('auth')->group (function () {
        Route::name ('personnels.')->group (function () {
            Route::controller (PersonnelController::class)->group (function () {
                Route::get ('/personnels/list', 'home')->name ('list');
                Route::get ('/personnels/add', 'add')->name ('add');
                Route::post ('/personnels/store', 'store')->name ('store');
                Route::get ('/personnels/edit/{id}', 'edit')->name ('edit');
                Route::post ('/personnels/update', 'update')->name ('update');
                Route::get ('/personnels/delete/{id}', 'delete')->name ('delete');
                Route::get ('/personnels/view/{id}', 'view')->name ('view');
                Route::get ('/personnels/statistique/{id}', 'statistique')->name ('statistique');
                Route::get ('/personnels/recommandation/{id}', 'recommandation')->name ('recommandation');
            });
        });
    });

