<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('user.profil', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            Log::info('Début de la mise à jour du profil', [
                'user_id' => $request->user()->id,
                'has_avatar' => $request->hasFile('avatar'),
            ]);

            $data = $request->validated();
            $user = $request->user();

            if ($request->hasFile('avatar')) {
                // Supprimer l'ancien avatar s'il existe
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }

                // Enregistrer le nouveau fichier
                $path = $request->file('avatar')->store('avatars', 'public');
                $data['avatar'] = $path;

                Log::info('Avatar uploadé avec succès', [
                    'user_id' => $user->id,
                    'path' => $path,
                ]);
            }

            // Mettre à jour les données de l'utilisateur
            $user->fill($data);

            // Si l'email a été modifié, réinitialiser la vérification d'email
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            // Sauvegarder les modifications
            $user->save();

            Log::info('Profil mis à jour avec succès', [
                'user_id' => $user->id,
                'updated_fields' => $user->getChanges()
            ]);

            return redirect()->route('profile.edit')
                           ->with('status', 'profile-updated')
                           ->with('success', 'Profil mis à jour avec succès!');

        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour du profil', [
                'user_id' => $request->user()->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()
                         ->with('error', 'Une erreur est survenue lors de la mise à jour du profil: ' . $e->getMessage());
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
