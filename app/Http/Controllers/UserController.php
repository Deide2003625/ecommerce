<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs (page d'administration)
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filtre recherche
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filtre statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtre rôle (relation many-to-many via Spatie Permission)
        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('id', $request->role);
            });
        }

        $users = $query->paginate(15);
        $roles = Role::all();

        return view('dashboard.user.index', compact('users', 'roles'));
    }

    /**
     * Créer un nouvel utilisateur (par l'admin)
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|exists:roles,id',
        ]);


        // Création de l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => null,
            'phone' => $validated['phone'] ?? null,
        ]);

        // Attribution du rôle sélectionné
        $role = Role::find($validated['role']);
        if ($role) {
            $user->assignRole($role);
        }
        notify()->success('Utilisateur créé avec succès.');
        return redirect()->back();;
    }

    /**
     * Afficher les détails d'un utilisateur
     */
    public function show(User $user)
    {
        return view('dashboard.user.profil', compact('user'));
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|exists:roles,id',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // Mise à jour des données
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        // Mise à jour du mot de passe si fourni
        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        // Synchronisation du rôle
        $role = Role::find($validated['role']);
        if ($role) {
            $user->syncRoles([$role]);
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour.');
    }

    /**
     * Supprimer un utilisateur
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
    }

    /**
     * Suppression multiple d'utilisateurs
     */
    /**
     * Suppression multiple d'utilisateurs
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->input('ids', []);

            if (empty($ids)) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Aucun utilisateur sélectionné.'], 400);
                }
                return redirect()->route('users.index')->with('error', 'Aucun utilisateur sélectionné.');
            }

            // Vérifier que les IDs sont bien des entiers
            $ids = array_filter($ids, 'is_numeric');

            // Supprimer les utilisateurs
            $deleted = User::whereIn('id', $ids)->delete();

            if ($deleted > 0) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => $deleted . ' utilisateur(s) supprimé(s) avec succès.'
                    ]);
                }
                return redirect()->route('users.index')->with('success', $deleted . ' utilisateur(s) supprimé(s) avec succès.');
            } else {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Aucun utilisateur n\'a pu être supprimé.'], 400);
                }
                return redirect()->route('users.index')->with('error', 'Aucun utilisateur n\'a pu être supprimé.');
            }
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la suppression des utilisateurs : ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => 'Une erreur est survenue lors de la suppression des utilisateurs.'], 500);
            }
            return redirect()->route('users.index')->with('error', 'Une erreur est survenue lors de la suppression des utilisateurs.');
        }
    }

    /**
     * Activer/Désactiver un utilisateur
     */
    public function toggleActive(User $user)
    {
        $user->is_active = ! $user->is_active;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Statut utilisateur mis à jour.',
            'is_active' => $user->is_active
        ]);
    }
}


