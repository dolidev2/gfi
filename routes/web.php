<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/accueil', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

require __DIR__.'/auth.php';
require __DIR__.'/route/users.php';
require __DIR__.'/route/agences.php';
require __DIR__.'/route/clients.php';
require __DIR__.'/route/mesures.php';
require __DIR__.'/route/tissus.php';
require __DIR__.'/route/modeles.php';
require __DIR__.'/route/commandes.php';
require __DIR__.'/route/paiement.php';
require __DIR__.'/route/report_rdv.php';
require __DIR__.'/route/remarques.php';
require __DIR__.'/route/personnel.php';

