<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    /**
     * Affiche la liste des commandes
     */
    public function index()
    {
        $commandes = Commande::with(['client', 'livreur', 'items'])
            ->withCount('items')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.commande.index', compact('commandes'));
    }

    /**
     * Affiche les détails d'une commande
     */
    public function show(Commande $commande)
    {
        $commande->load(['client', 'livreur', 'items.produit']);
        return view('commande.show', compact('commande'));
    }

    /**
     * Affiche le formulaire de création d'une commande
     */
    public function create()
    {
        $clients = User::role('client')->get();
        $livreurs = User::role('livreur')->get();

        return view('commande.create', compact('clients', 'livreurs'));
    }

    /**
     * Enregistre une nouvelle commande
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:users,id',
            'livreur_id' => 'nullable|exists:users,id',
            'date_livraison' => 'nullable|date',
            'statut' => 'required|in:en_attente,en_preparation,expediee,livree,annulee',
            'items' => 'required|array',
            'items.*.produit_id' => 'required|exists:produits,id',
            'items.*.quantite' => 'required|integer|min:1',
            'items.*.prix_unitaire' => 'required|numeric|min:0',
        ]);

        return DB::transaction(function () use ($validated) {
            $commande = Commande::create([
                'client_id' => $validated['client_id'],
                'livreur_id' => $validated['livreur_id'] ?? null,
                'date_livraison' => $validated['date_livraison'] ?? null,
                'statut' => $validated['statut'],
                'total' => 0,
            ]);

            $total = 0;
            foreach ($validated['items'] as $item) {
                $commande->items()->create([
                    'produit_id' => $item['produit_id'],
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $item['prix_unitaire'],
                    'total' => $item['quantite'] * $item['prix_unitaire'],
                ]);
                $total += $item['quantite'] * $item['prix_unitaire'];
            }

            $commande->update(['total' => $total]);

            return redirect()
                ->route('commandes.show', $commande)
                ->with('success', 'Commande créée avec succès');
        });
    }

    /**
     * Affiche le formulaire de modification d'une commande
     */
    public function edit(Commande $commande)
    {
        $commande->load('items.produit');
        $clients = User::role('client')->get();
        $livreurs = User::role('livreur')->get();

        return view('commande.edit', compact('commande', 'clients', 'livreurs'));
    }

    /**
     * Met à jour une commande existante
     */
    public function update(Request $request, Commande $commande)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:users,id',
            'livreur_id' => 'nullable|exists:users,id',
            'date_livraison' => 'nullable|date',
            'statut' => 'required|in:en_attente,en_preparation,expediee,livree,annulee',
        ]);

        $commande->update($validated);

        return redirect()
            ->route('commandes.show', $commande)
            ->with('success', 'Commande mise à jour avec succès');
    }

    /**
     * Annule une commande
     */
    public function annuler(Commande $commande)
    {
        if ($commande->statut === 'annulee') {
            return back()->with('error', 'La commande est déjà annulée');
        }

        $commande->update(['statut' => 'annulee']);

        return back()->with('success', 'Commande annulée avec succès');
    }
}
