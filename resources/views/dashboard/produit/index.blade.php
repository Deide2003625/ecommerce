@extends('dashboard.master')
@section('title', 'Liste des produits')
@section('content')
<div class="dashboard-main-body">
    <div class="card radius-12 overflow-hidden mb-3">
        <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
            <h6 class="text-white mb-0 fw-semibold d-flex align-items-center">Liste des produits</h6>
        </div>
        <div class="card-body p-24">
            <a href="{{ route('produits.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Sous-catégorie</th>
                            <th>Image</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produits as $index => $produit)
                            <tr>
                                <td>{{ $produits->firstItem() + $index }}</td>
                                <td>{{ $produit->nom }}</td>
                                <td>{{ $produit->description ?? '—' }}</td>
                                <td>{{ $produit->prix }}</td>
                                <td>{{ $produit->sousCategorie->nom ?? '—' }}</td>
                                <td>
                                    @if($produit->getFirstMediaUrl('produits'))
                                        <img src="{{ $produit->getFirstMediaUrl('produits') }}" alt="Image" style="width:40px;height:40px;object-fit:cover;border-radius:8px;">
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-info btn-sm">Voir</a>
                                    <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Supprimer ce produit ?')" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucun produit enregistré</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $produits->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
