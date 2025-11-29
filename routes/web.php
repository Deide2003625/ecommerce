<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirection de la page d'accueil vers le login
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Routes d'authentification (Breeze)
|--------------------------------------------------------------------------
| Gestion complète de l'authentification et des utilisateurs admin :
| - Login, Register, Forgot Password, Reset Password, Email Verification
| - CRUD complet des utilisateurs (réservé aux administrateurs)
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Routes protégées (authentification requise)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil utilisateur
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Gestion des clients (consultation uniquement - création via API)
    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
    });

    // Gestion des commandes
    Route::prefix('commandes')->name('commandes.')->group(function () {
        Route::get('/', [CommandeController::class, 'index'])->name('index');
        Route::get('/create', [CommandeController::class, 'create'])->name('create');
        Route::post('/', [CommandeController::class, 'store'])->name('store');
        Route::get('/{commande}', [CommandeController::class, 'show'])->name('show');
        Route::get('/{commande}/edit', [CommandeController::class, 'edit'])->name('edit');
        Route::patch('/{commande}', [CommandeController::class, 'update'])->name('update');
        Route::patch('/{commande}/annuler', [CommandeController::class, 'annuler'])->name('annuler');
    });

});

// Routes publiques (à ajouter si nécessaire)
// ...
