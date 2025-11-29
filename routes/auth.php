<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

/*
|--------------------------------------------------------------------------
| Routes d'authentification (Breeze + Extensions)
|--------------------------------------------------------------------------
| Authentification classique + Google OAuth pour les clients
*/

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::get('check-email', [AuthenticatedSessionController::class, 'checkEmail'])
        ->name('check.email');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    // Google OAuth (à implémenter avec Laravel Socialite)
    Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])
        ->name('auth.google');

    Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])
        ->name('auth.google.callback');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Gestion des utilisateurs (Admin uniquement)
    |--------------------------------------------------------------------------
    */

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::patch('/{user}', [UserController::class, 'update'])->name('update');
        Route::patch('/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('toggle-active');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-delete', [UserController::class, 'bulkDestroy'])->name('bulk-delete');
    });

    // Gestion des rôles
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{role}', [RoleController::class, 'show'])->name('show');
        Route::patch('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
        Route::post('/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.update-permissions');
        Route::get('/roles/{role}/permissions-list', [RoleController::class, 'getPermissions'])->name('get-permissions');
        Route::post('/roles/{role}/toggle-permission', [RoleController::class, 'togglePermission'])->name('role-toggle-permission');

    });
});
