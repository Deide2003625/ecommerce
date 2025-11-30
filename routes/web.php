<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ValeurOptionController;
use App\Http\Controllers\OptionProduitController;
use App\Http\Controllers\VarianteProduitController;
use App\Http\Controllers\Dashboard\DashboardController;

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

    // Gestion des catégories
    Route::resource('categories', CategorieController::class);

    // Sous-catégorie (ajout/suppression via CategorieController)
    Route::post('categories/{category}/subcategories', [CategorieController::class, 'addSubcategory'])->name('categories.subcategories.store');
    Route::delete('categories/{category}/subcategories/{subcategory}', [CategorieController::class, 'deleteSubcategory'])->name('categories.subcategories.destroy');

    // Gestion des produits
    Route::resource('produits', ProduitController::class);

    // Options de produit (imbriquées)
    Route::resource('produits.options', OptionProduitController::class)->shallow();

    // Valeurs d'option (imbriquées)
    Route::resource('options.valeurs', ValeurOptionController::class)->shallow();

    // Variantes de produit (imbriquées)
    Route::resource('produits.variantes', VarianteProduitController::class)->shallow();

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
