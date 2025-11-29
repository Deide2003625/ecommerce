@extends('dashboard.master')
@section('title', 'Liste des clients')

@section('content')

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Liste des clients</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Tableau de bord
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Clients</li>
        </ul>
    </div>

    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <form class="navbar-search">
                    <input type="text" class="bg-base h-40-px" name="search" placeholder="Rechercher un client...">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </form>
            </div>
        </div>
        
        <div class="card-body p-24">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date d'inscription</th>
                            <th>Nom & Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th class="text-center">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                        <tr>
                            <td>#{{ $client->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y') }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone ?? '-' }}</td>
                            <td class="text-center">
                                @if($client->is_active)
                                    <span class="badge bg-success">Actif</span>
                                @else
                                    <span class="badge bg-danger">Inactif</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Aucun client trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($clients->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Affichage de {{ $clients->firstItem() }} à {{ $clients->lastItem() }} sur {{ $clients->total() }} clients
                </div>
                <div>
                    {{ $clients->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
