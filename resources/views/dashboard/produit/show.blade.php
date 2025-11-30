@extends('dashboard.master')
@section('title', 'Détail du produit')
@section('content')
<div class="dashboard-main-body">
    <div class="card radius-12 overflow-hidden mb-3">
        <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
            <h6 class="text-white mb-0 fw-semibold d-flex align-items-center">Détail du produit</h6>
        </div>
        <div class="card-body p-24">
            <div class="mb-20">
                <strong>Nom :</strong> {{ $produit->nom }}
            </div>
            <div class="mb-20">
                <strong>Description :</strong> {{ $produit->description ?? '—' }}
            </div>
            <div class="mb-20">
                <strong>Prix :</strong> {{ $produit->prix }}
            </div>
            <div class="mb-20">
                <strong>Sous-catégorie :</strong> {{ $produit->sousCategorie->nom ?? '—' }}
            </div>
            <div class="mb-20">
                <strong>Image :</strong><br>
                @if($produit->getFirstMediaUrl('produits'))
                    <img src="{{ $produit->getFirstMediaUrl('produits') }}" alt="Image" style="width:120px;height:120px;object-fit:cover;border-radius:8px;">
                @else
                    —
                @endif
            </div>
            <a href="{{ route('produits.index') }}" class="btn btn-outline-primary radius-8 py-10">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
