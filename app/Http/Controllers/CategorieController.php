<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class CategorieController extends Controller
{
    /**
     * Afficher une catégorie
     */
    public function show(Categorie $category)
    {
        $category->load(['subCategories' => function ($query) {
            $query->where('is_deleted', false);
        }]);
        return view('dashboard.category.show', [
            'category' => $category,
        ]);
    }
    /**
     * Afficher la liste des catégories
     */
    public function index(Request $request)
    {
        $categories = Categorie::with('media')->where('is_deleted', false)->paginate(15);
        return view('dashboard.category.index', compact('categories'));
    }

    /**
     * Enregistrer une nouvelle catégorie
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'media' => 'nullable|max:2048',
        ]);
        $category = Categorie::create([
            'nom' => $validated['nom'],
            'description' => $validated['description'] ?? null,
        ]);

        if ($request->hasFile('media')) {
            $category->addMediaFromRequest('media')->toMediaCollection('categories');
        }

        return response()->json([
            'success' => true,
            'message' => 'Catégorie ajoutée avec succès !',
            'category' => $category
        ]);
    }
    /**
     * Mettre à jour une catégorie
     */
    public function update(Request $request, Categorie $category)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'media' => 'nullable|max:2048',
        ]);

        $category->update([
            'nom' => $validated['nom'],
            'description' => $validated['description'] ?? null,
        ]);

        if ($request->hasFile('media')) {
            $category->clearMediaCollection('categories');
            $category->addMediaFromRequest('media')->toMediaCollection('categories');
        }
        notify()->success('Catégorie mise à jour avec succès !');
        return response()->json([
            'success' => true,
            'message' => 'Catégorie modifiée avec succès !',
            'category' => $category
        ]);
    }

    /**
     * Supprimer une catégorie
     */
    public function destroy(Categorie $category)
    {
        $category->clearMediaCollection('categories');
        $category->is_deleted = true;
        $category->save();
        return response()->json([
            'success' => true,
            'message' => 'Catégorie supprimée avec succès !'
        ]);
    }


    public function addSubcategory(Request $request, Categorie $category)
    {
        $validated = $request->validate([
            'noms' => 'required|string',
        ]);
        $noms = array_filter(array_map('trim', explode("\n", $validated['noms'])));
        $count = 0;
        foreach ($noms as $nom) {
            if ($nom !== '') {
                $category->subCategories()->create(['nom' => $nom]);
                $count++;
            }
        }
        notify()->success($count . ' sous-catégorie(s) ajoutée(s) !');
        return redirect()->back();
    }

    /**
     * Supprimer une sous-catégorie (soft delete)
     */
    public function deleteSubcategory(Categorie $category, $subcategoryId)
    {
        $subcategory = $category->subCategories()->findOrFail($subcategoryId);
        if ($subcategory->produits()->exists()) {
            notify()->error('Impossible de supprimer : des produits sont associés à cette sous-catégorie.');
            return redirect()->back();
        }
        $subcategory->delete();
        notify()->success('Sous-catégorie supprimée définitivement !');
        return redirect()->back();
    }
}
