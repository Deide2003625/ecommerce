@extends('dashboard.master')
@section('title', 'Gestion des commandes')

@section('content')

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Liste des commandes</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Tableau de bord
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Commandes</li>
        </ul>
    </div>
                             
    <div class="row">
        <div class="col-12">
            <div class="card h-100 p-0 radius-12">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        <span class="text-md fw-medium text-secondary-light mb-0">Afficher</span>
                        <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        
                        <form class="navbar-search">
                            <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Rechercher une commande...">
                            <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                        </form>

                        <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                            <option>Tous les statuts</option>
                            <option>En attente</option>
                            <option>En préparation</option>
                            <option>Expédiée</option>
                            <option>Livrée</option>
                            <option>Annulée</option>
                        </select>
                    </div>
                   
                   
                </div>

                <div class="card-body p-24">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>N° Commande</th>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Montant</th>
                                    <th>Produits</th>
                                    <th>Livreur</th>
                                    <th>Livraison prévue</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($commandes as $commande)
                                <tr>
                                    <td>#{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($commande->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="text-md fw-medium">{{ $commande->client->name ?? 'Client inconnu' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ number_format($commande->total, 2, ',', ' ') }} €</td>
                                    <td>
                                        <span class="badge bg-primary-50 text-primary-600">
                                            {{ $commande->items_count }} article(s)
                                        </span>
                                    </td>
                                    <td>{{ $commande->livreur->name ?? 'Non attribué' }}</td>
                                    <td>
                                        @if($commande->date_livraison)
                                            {{ \Carbon\Carbon::parse($commande->date_livraison)->format('d/m/Y') }}
                                            @if($commande->date_livraison->isPast() && $commande->statut !== 'livree')
                                                <span class="text-danger ms-1" title="En retard">
                                                    <iconify-icon icon="mdi:alert-circle-outline"></iconify-icon>
                                                </span>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $badgeClass = [
                                                'en_attente' => 'bg-warning-50 text-warning-600',
                                                'en_preparation' => 'bg-info-50 text-info-600',
                                                'expediee' => 'bg-primary-50 text-primary-600',
                                                'livree' => 'bg-success-50 text-success-600',
                                                'annulee' => 'bg-danger-50 text-danger-600',
                                            ][$commande->statut] ?? 'bg-secondary-50 text-secondary-600';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center gap-2 justify-content-center">
                                            <a href="{{ route('commandes.show', $commande->id) }}" 
                                               class="btn btn-icon btn-sm btn-info" 
                                               title="Voir les détails">
                                                <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                                            </a>
                                            
                                            @if($commande->statut !== 'livree' && $commande->statut !== 'annulee')
                                                <a href="{{ route('commandes.edit', $commande->id) }}" 
                                                   class="btn btn-icon btn-sm btn-primary" 
                                                   title="Modifier">
                                                    <iconify-icon icon="mdi:pencil-outline"></iconify-icon>
                                                </a>
                                                
                                                @if($commande->statut === 'en_attente')
                                                    <form action="{{ route('commandes.annuler', $commande->id) }}" 
                                                          method="POST" 
                                                          onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?')">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-icon btn-sm btn-danger" title="Annuler">
                                                            <iconify-icon icon="mdi:close-circle-outline"></iconify-icon>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center py-5">
                                            <iconify-icon icon="mdi:package-variant-remove" class="text-muted" style="font-size: 3rem;"></iconify-icon>
                                            <p class="mt-3 mb-0 text-muted">Aucune commande trouvée</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($commandes->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Affichage de {{ $commandes->firstItem() }} à {{ $commandes->lastItem() }} sur {{ $commandes->total() }} commandes
                        </div>
                        <div>
                            {{ $commandes->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection