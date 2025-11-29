<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    /**
     * Rediriger vers Google pour l'authentification
     *
     * TODO: Installer Laravel Socialite
     * composer require laravel/socialite
     */
    public function redirectToGoogle()
    {
        // Vérifier si Socialite est installé
        if (!class_exists(\Laravel\Socialite\Facades\Socialite::class)) {
            return redirect()->route('login')->with('error',
                'Google OAuth n\'est pas encore configuré. Veuillez installer Laravel Socialite.'
            );
        }

        return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    }

    /**
     * Gérer le callback de Google OAuth
     */
    public function handleGoogleCallback()
    {
        try {
            // Vérifier si Socialite est installé
            if (!class_exists(\Laravel\Socialite\Facades\Socialite::class)) {
                return redirect()->route('login')->with('error',
                    'Google OAuth n\'est pas encore configuré.'
                );
            }

            $googleUser = \Laravel\Socialite\Facades\Socialite::driver('google')->user();

            // Vérifier si l'utilisateur existe déjà
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Mettre à jour les informations Google
                $user->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                ]);
            } else {
                // Créer un nouveau compte utilisateur
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'password' => Hash::make(Str::random(24)), // Mot de passe aléatoire
                    'email_verified_at' => now(), // Email déjà vérifié par Google
                ]);

                // Assigner le rôle "client" par défaut
                $user->assignRole('client');
            }

            // Connecter l'utilisateur
            Auth::login($user);

            return redirect()->intended('/dashboard')->with('success',
                'Connexion réussie avec Google!'
            );

        } catch (\Exception $e) {
            \Log::error('Google OAuth Error: ' . $e->getMessage());

            return redirect()->route('login')->with('error',
                'Erreur lors de la connexion avec Google. Veuillez réessayer.'
            );
        }
    }
}
