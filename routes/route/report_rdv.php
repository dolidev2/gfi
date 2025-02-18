<?php

    use \App\Http\Controllers\clients\ReportRdvController;
    use Illuminate\Support\Facades\Route;

    Route::middleware ('auth')->group (function () {
        Route::name ('client.commande.report.')->group (function () {
            Route::controller (ReportRdvController::class)->group (function () {
                Route::post ('/client/commande/report/store', 'store')->name ('store');
                Route::get ('/client/commande/report/viewOne/{id}', 'viewOne')->name ('viewOne');
                Route::post ('/client/commande/report/update', 'update')->name ('update');
                Route::get ('/client/commande/report/delete/{id}', 'delete')->name ('delete');
                Route::get ('/client/commande/report/view/{commande}', 'view')->name ('view');
                Route::get ('/client/{client}/commande/report/print/{id}', 'print')->name ('print');
            });
        });
    });
