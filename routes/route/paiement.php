<?php

    use \App\Http\Controllers\clients\PaiementController;
    use Illuminate\Support\Facades\Route;

    Route::middleware ('auth')->group (function () {
        Route::name ('client.commande.paiement.')->group (function () {
            Route::controller (PaiementController::class)->group (function () {
                Route::get ('/client/{client}/commande/paiement/view/{id}', 'view')->name ('view');
                Route::get ('/client/{client}/commande/paiement/print/{id}', 'print')->name ('print');
                Route::get ('/client/{client}/commande/paiement/printAll/{commande}', 'printAll')->name ('printAll');
                Route::post ('/client/commande/paiement/store', 'store')->name ('store');
                Route::post ('/client/commande/paiement/update', 'update')->name ('update');
                Route::get ('/client/commande/paiement/delete/{id}', 'delete')->name ('delete');
            });
        });
    });

