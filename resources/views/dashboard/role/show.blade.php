@extends('dashboard.master')
@section('title', 'Détails du Rôle')
@section('content')
<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Détails du rôle : {{ $role->name }}</h6>
        <div class="text-muted mt-2">{{ $role->description ?? '—' }}</div>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('roles.index') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:shield-user-outline" class="icon text-lg"></iconify-icon>
                    Rôles
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Détails</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="card h-100 p-0 radius-12">
                <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
                    <h6 class="text-white mb-0 fw-semibold d-flex align-items-center">
                        <span>Liste des permissions</span>
                    </h6>
                </div>
                <div class="card-body p-24">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table sm-table mb-0" id="permission-table">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Description</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $index => $permission)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="max-width:170px; width:170px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ ucfirst($permission->name) }}</td>
                                        <td>{{ ucfirst($permission->description) }}</td>
                                        <td class="text-center">
                                            <button id="add{{ $permission->id }}"
                                                data-permission="{{ $permission->id }}"
                                                class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle btn toggle-permission {{ $role->permissions->contains($permission) ? 'd-none' : '' }}"
                                                title="Ajouter permission">
                                                <iconify-icon icon="lucide:plus" class="menu-icon"></iconify-icon>
                                            </button>
                                            <button id="remove{{ $permission->id }}"
                                                data-permission="{{ $permission->id }}"
                                                class="bg-danger-focus text-danger-600 bg-hover-danger-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle btn toggle-permission {{ !$role->permissions->contains($permission) ? 'd-none' : '' }}"
                                                title="Retirer permission">
                                                <iconify-icon icon="lucide:minus" class="menu-icon"></iconify-icon>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card h-100 p-0 radius-12">
                <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
                    <h6 class="text-white mb-0 fw-semibold d-flex align-items-center">
                        <span>Permissions associées</span>
                    </h6>
                </div>
                <div class="card-body p-24">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table sm-table mb-0" id="permission_assigned">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Nom</th>
                                </tr>
                            </thead>
                            <tbody id="permission_table">
                                @forelse ($role->permissions as $key => $permission)
                                    <tr class="align-middle" style="height:60px !important">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $permission->name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">Aucune permission associée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function getPermissions(roleId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('roles.get-permissions', ':id') }}'.replace(':id', roleId),
                    success: function(response) {
                        const tbody = $('#permission_table');
                        tbody.empty();
                        if (response.length > 0) {
                            $.each(response, function(index, permission) {
                                tbody.append('<tr class="align-middle" style="height:60px !important"><td>' + (index + 1) + '</td><td>' + permission.name + '</td></tr>');
                            });
                        } else {
                            tbody.append('<tr class="align-middle" style="height:60px !important"><td colspan="2" class="text-center">Aucune permission associée</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Erreur lors de la récupération des permissions : " + error);
                    }
                });
            }
            $('body').on('click', '.toggle-permission', function() {
                var permissionId = $(this).data('permission');
                var roleId = {{ $role->id }};
                $.ajax({
                    url: '{{ route("roles.role-toggle-permission", ":roleId") }}'.replace(':roleId', roleId),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        permission: permissionId
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#add' + permissionId).addClass('d-none');
                            $('#remove' + permissionId).removeClass('d-none');
                        } else {
                            $('#remove' + permissionId).addClass('d-none');
                            $('#add' + permissionId).removeClass('d-none');
                        }
                        getPermissions(roleId);
                        // showNotification('success', 'Succès', response.message);
                    },
                    error: function(response) {
                        alert('Une erreur s\'est produite');
                    }
                });
            });
            getPermissions({{ $role->id }});
        });
    </script>
</div>
@endsection
