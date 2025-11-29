<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    // ...existing code...
    public function getPermissions(Role $role)
    {
        $permissions = $role->permissions()->get();
        return response()->json($permissions);
    }

    public function togglePermission(Request $request, Role $role)
    {
        $permissionId = $request->input('permission');
        $exists = $role->permissions()->where('id', $permissionId)->exists();
        if ($exists) {
            $role->permissions()->detach($permissionId);
        } else {
            $role->permissions()->attach($permissionId);
        }
        return response()->json([
            'exists' => !$exists,
            'message' => $exists ? 'Permission retirée du rôle.' : 'Permission ajoutée au rôle.'
        ]);
    }
    // ...existing code...
// ...existing code...
    public function updatePermissions(Request $request, Role $role)
    {
        $permissionIds = $request->input('permissions', []);
        $role->permissions()->sync($permissionIds);
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Permissions mises à jour avec succès']);
        }
        return back()->with('success', 'Permissions mises à jour avec succès');
    }
    public function index()
    {
        $roles = Role::where('is_deleted', false)->paginate(10);
        return view('dashboard.role.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        Role::create($validated);
        return response()->json(['success' => true, 'message' => 'Rôle créé avec succès']);
    }

    public function show(Role $role)
    {
        $permissions = \App\Models\Permission::all();
        // Pour AJAX, retourner la vue partielle du modal
        if (request()->ajax()) {
            return view('dashboard.role.show', compact('role', 'permissions'))->render();
        }
        return view('dashboard.role.show', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $role->update($validated);
        return response()->json(['success' => true, 'message' => 'Rôle mis à jour avec succès']);
    }

    public function destroy(Role $role)
    {
        $role->is_deleted = true;
        $role->save();
        return response()->json(['success' => true, 'message' => 'Rôle supprimé (soft delete)']);
    }
}
