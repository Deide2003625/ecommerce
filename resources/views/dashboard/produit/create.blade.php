@extends('dashboard.master')
@section('title', 'Ajouter un produit')
@section('content')
<div class="dashboard-main-body">
    <div class="card radius-12 overflow-hidden mb-3">
        <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
            <h6 class="text-white mb-0 fw-semibold d-flex align-items-center">Ajouter un produit</h6>
        </div>
        <div class="card-body p-24">
            <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-20">
                    <label for="nom" class="form-label fw-semibold text-primary-light text-sm mb-8">Nom <span class="text-danger-600 ms-1">*</span></label>
                    <input type="text" name="nom" class="form-control radius-8 py-10" id="nom" required>
                </div>
                <div class="mb-20">
                    <label for="description" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                    <textarea name="description" class="form-control radius-8 py-10" id="description"></textarea>
                </div>
                <div class="mb-20">
                    <label for="prix" class="form-label fw-semibold text-primary-light text-sm mb-8">Prix <span class="text-danger-600 ms-1">*</span></label>
                    <input type="number" name="prix" class="form-control radius-8 py-10" id="prix" required step="0.01">
                </div>
                <div class="mb-20">
                    <label for="sous_categorie_id" class="form-label fw-semibold text-primary-light text-sm mb-8">Sous-catégorie <span class="text-danger-600 ms-1">*</span></label>
                    <select name="sous_categorie_id" class="form-control radius-8 py-10" id="sous_categorie_id" required>
                        <option value="">Sélectionner</option>
                        @foreach($sousCategories as $sc)
                            <option value="{{ $sc->id }}">{{ $sc->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-20">
                    <label for="media" class="form-label fw-semibold text-primary-light text-sm mb-8">Image</label>
                    <input type="file" name="media" class="form-control radius-8 py-10" id="media" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary radius-8 px-4">Enregistrer</button>
            </form>
        </div>
    </div>
</div>
@endsection
