<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserData;
use Spatie\Permission\Models\Role;

class SuperadminController extends Controller
{
    //
     public function index()
    {
        $roles = Role::all();
        return view('user.register', compact('roles'));
    }

     public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|exists:roles,id',
        ]);

        // Insertion dans la base de données (table users via le modèle UserData)
        $user = UserData::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        // Attribution du rôle sélectionné (Spatie Permission)
        $role = Role::find($validated['role']);
        if ($role) {
            $user->assignRole($role);
        }

        // Redirection avec un message de succès
        return redirect()->route('register')->with('success', 'Utilisateur créé avec succès.');
    }

    public function list()
    {
        $users = UserData::with('roles')->paginate(9);
        $roles = Role::all();
        return view('user.register', compact('users', 'roles'));
    }

    public function show(UserData $user)
    {
        return view('user.profil', ['user' => $user]);
    }

    public function update(Request $request, UserData $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|exists:roles,id',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        $role = Role::find($validated['role']);
        if ($role) {
            $user->syncRoles([$role]);
        }

        return redirect()->route('register')->with('success', 'Utilisateur mis à jour.');
    }

    public function destroy(UserData $user)
    {
        $user->delete();
        return redirect()->route('register')->with('success', 'Utilisateur supprimé.');
    }

    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            
            if (empty($ids)) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Aucun utilisateur sélectionné.'], 400);
                }
                return redirect()->route('register')->with('error', 'Aucun utilisateur sélectionné.');
            }

            // Vérifier que les IDs sont bien des entiers
            $ids = array_filter($ids, 'is_numeric');
            
            // Supprimer les utilisateurs
            $deleted = UserData::whereIn('id', $ids)->delete();
            
            if ($deleted > 0) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => $deleted . ' utilisateur(s) supprimé(s) avec succès.'
                    ]);
                }
                return redirect()->route('register')->with('success', $deleted . ' utilisateur(s) supprimé(s) avec succès.');
            } else {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Aucun utilisateur n\'a pu être supprimé.'], 400);
                }
                return redirect()->route('register')->with('error', 'Aucun utilisateur n\'a pu être supprimé.');
            }
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la suppression des utilisateurs : ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => 'Une erreur est survenue lors de la suppression des utilisateurs.'], 500);
            }
            return redirect()->route('register')->with('error', 'Une erreur est survenue lors de la suppression des utilisateurs.');
        }
    }

    public function toggleActive(UserData $user)
    {
        $user->is_active = ! $user->is_active;
        $user->save();

        return redirect()->route('register')->with('success', 'Statut utilisateur mis à jour.');
    }

}


