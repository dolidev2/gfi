<?php

    use App\Http\Controllers\clients\CommandeController;
    use Illuminate\Support\Facades\Route;

    Route::middleware ('auth')->group (function () {
        Route::name ('client.commande.')->group (function () {
            Route::controller (CommandeController::class)->group (function () {
                Route::post ('/client/commande/store', 'store')->name ('store');
                Route::post ('/client/commande/composition/store', 'storeComposition')->name ('storeComposition');
                Route::post ('/client/commande/update', 'update')->name ('update');
                Route::get ('/client/commande/delete/{id}', 'delete')->name ('delete');
                Route::get ('/client/commande/composition/delete/{id}', 'deleteComposition')->name ('deleteComposition');
                Route::get ('/client/{client}/commande/view/{id}', 'view')->name ('view');
                Route::get ('/client/commande/view/{id}', 'viewOne')->name ('viewOne');
                Route::get ('/client/{client}/commande/print/{id}', 'print')->name ('print');
                Route::get ('/client/{client}/commande/printAll', 'printAll')->name ('printAll');
            });
        });
    });
