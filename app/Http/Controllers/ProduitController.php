<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\SousCategorie;
use App\Models\OptionProduit;
use App\Models\VarianteProduit;

class ProduitController extends Controller
{
    // Affiche la liste des produits
    public function index()
    {
        $produits = Produit::with(['sousCategorie', 'options', 'variantes', 'media'])->paginate(15);
        return view('dashboard.produit.index', compact('produits'));
    }

    // Formulaire de création
    public function create()
    {
        $sousCategories = SousCategorie::where('is_deleted', false)->get();
        return view('dashboard.produit.create', compact('sousCategories'));
    }

    // Enregistre un nouveau produit
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'sous_categorie_id' => 'required|exists:sous_categories,id',
            'media' => 'nullable|image|max:2048',
        ]);

        $produit = Produit::create($data);
        if ($request->hasFile('media')) {
            $produit->addMediaFromRequest('media')->toMediaCollection('produits');
        }
        notify()->success('Produit ajouté avec succès!');
        return redirect()->route('produits.index');
    }

    // Affiche le détail d'un produit
    public function show(Produit $produit)
    {
        $produit->load(['sousCategorie', 'options.valeurs', 'variantes', 'media']);
        return view('dashboard.produit.show', compact('produit'));
    }

    // Formulaire d'édition
    public function edit(Produit $produit)
    {
        $sousCategories = SousCategorie::where('is_deleted', false)->get();
        $produit->load(['options.valeurs', 'variantes', 'media']);
        return view('dashboard.produit.edit', compact('produit', 'sousCategories'));
    }

    // Met à jour le produit
    public function update(Request $request, Produit $produit)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'sous_categorie_id' => 'required|exists:sous_categories,id',
            'media' => 'nullable|image|max:2048',
        ]);

        $produit->update($data);
        if ($request->hasFile('media')) {
            $produit->clearMediaCollection('produits');
            $produit->addMediaFromRequest('media')->toMediaCollection('produits');
        }
        notify()->success('Produit mis à jour!');
        return redirect()->route('produits.index');
    }

    // Supprime le produit
    public function destroy(Produit $produit)
    {
        $produit->delete();
        notify()->success('Produit supprimé!');
        return redirect()->route('produits.index');
    }
}
