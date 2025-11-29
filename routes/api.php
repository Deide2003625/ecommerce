<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientController as ApiClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Routes pour l'API REST (utilisées par les clients mobiles/web)
| Authentification via Sanctum
*/

// Routes publiques (sans authentification)
Route::prefix('v1')->group(function () {

    // Authentification API
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

    // OAuth Google (à implémenter)
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

});

// Routes protégées (authentification Sanctum requise)
Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {

    // Profil utilisateur connecté
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::put('/user/profile', [AuthController::class, 'updateProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Gestion des commandes (clients) - à implémenter
    // Route::prefix('commandes')->group(function () {
    //     Route::get('/', [\App\Http\Controllers\Api\CommandeController::class, 'index']);
    //     Route::post('/', [\App\Http\Controllers\Api\CommandeController::class, 'store']);
    //     Route::get('/{commande}', [\App\Http\Controllers\Api\CommandeController::class, 'show']);
    // });

});
