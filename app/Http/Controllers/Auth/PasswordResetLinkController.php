<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
    use App\Notifications\CustomResetPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('dashboard.auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user) {
            $token = \Illuminate\Support\Facades\Password::broker()->createToken($user);
            $user->notify(new CustomResetPassword($token));
            return response()->json([
                'success' => true,
                'message' => 'Le lien de réinitialisation a été envoyé !',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Aucun utilisateur trouvé avec cet email.',
                'errors' => ['email' => 'Aucun utilisateur trouvé avec cet email.'],
            ]);
        }
    }
}
