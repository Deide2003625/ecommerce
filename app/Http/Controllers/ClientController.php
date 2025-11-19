<?php

namespace App\Http\Controllers;

use App\Models\UserData as User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ClientController extends Controller
{
    /**
     * Affiche la liste des clients
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer les utilisateurs ayant le rôle 'Client' ou 'client'
        $clients = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['Client', 'client']);
        })
        ->with('roles')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        // Pour le débogage - à supprimer en production
        \Log::info('Clients trouvés : ' . $clients->count());
        
        return view('client.client', compact('clients'));
    }
}
