<?php

    use App\Http\Controllers\ModeleController;
    use Illuminate\Support\Facades\Route;

    Route::middleware ('auth')->group (function () {
        Route::name ('modeles.')->group (function () {
            Route::controller (ModeleController::class)->group (function () {
                Route::get ('/modeles/list', 'home')->name ('list');
                Route::get ('/modeles/add', 'add')->name ('add');
                Route::get ('/modeles/modeles', 'view')->name ('view');
                Route::post ('/modeles/store', 'store')->name ('store');
                Route::get ('/modeles/edit/{id}', 'edit')->name ('edit');
                Route::get ('/modeles/view/{id}', 'viewOne')->name ('viewOne');
                Route::post ('/modeles/update', 'update')->name ('update');
                Route::get ('/modeles/delete/{id}', 'delete')->name ('delete');
                Route::get ('/modeles/{modele}/delete/{id}', 'deleteComposition')->name ('deleteComposition');
                Route::get ('/modeles/detail/{id}', 'detail')->name ('detail');
            });
        });
    });

