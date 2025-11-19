<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\User\SuperadminController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';

// Utilisateurs: liste + formulaire sur la même page
Route::get('user/register', [SuperadminController::class, 'list'])->name('register');
Route::post('store_user', [SuperadminController::class, 'store'])->name('insert');

// Suppression d'un utilisateur
Route::delete('user/{user}', [SuperadminController::class, 'destroy'])->name('user.destroy');

// Suppression multiple
Route::middleware('auth')->post('user/bulk-delete', [SuperadminController::class, 'bulkDestroy'])->name('user.bulk-destroy');

// Mise à jour d'un utilisateur
Route::patch('user/{user}', [SuperadminController::class, 'update'])->name('user.update');

// Affichage d'un utilisateur (vue de détail)
Route::get('user/{user}/show', [SuperadminController::class, 'show'])->name('user.show');

// Toggle statut actif/inactif
Route::patch('user/{user}/toggle-active', [SuperadminController::class, 'toggleActive'])->name('user.toggle-active');

// Liste des clients
Route::get('/clients', [\App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');

// Gestion des commandes
Route::prefix('commandes')->name('commandes.')->group(function () {
    Route::get('/', [\App\Http\Controllers\CommandeController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\CommandeController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\CommandeController::class, 'store'])->name('store');
    Route::get('/{commande}', [\App\Http\Controllers\CommandeController::class, 'show'])->name('show');
    Route::get('/{commande}/edit', [\App\Http\Controllers\CommandeController::class, 'edit'])->name('edit');
    Route::patch('/{commande}', [\App\Http\Controllers\CommandeController::class, 'update'])->name('update');
    Route::patch('/{commande}/annuler', [\App\Http\Controllers\CommandeController::class, 'annuler'])->name('annuler');
})->middleware('auth');
