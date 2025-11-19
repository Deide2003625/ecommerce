<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('dashboard.auth.login');
    }

    public function checkEmail(Request $request): JsonResponse
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if ($user) {
            return response()->json(['success' => true, 'password' => $user->password]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        if ($request->password && $request->password_confirmation) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8',
            ]);
            $user = User::where('email', $request->email)->first();

            $user->password = Hash::make($request->password);

            $user->save();

            Auth::login($user);

            notify()->success('Bienvenu(e) ! Votre mot de passe modifié avec succès!', 'Succès');

            return response()->json(['success' => true, 'redirect' => route('dashboard', absolute: false)]);

        } else {
            $request->authenticate();

            $request->session()->regenerate();

            notify()->success('Connexion réussie !', 'Succès');

            return response()->json(['success' => true, 'redirect' => route('dashboard', absolute: false)]);

        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        notify()->success('Deconnexion réussie !','Succès');

        return response()->json(['success' => true, 'redirect' => route('login', absolute: false)]);
    }
}
