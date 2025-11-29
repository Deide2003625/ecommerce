@extends('dashboard.master')
@section('title', 'Dashboard')

@section('content')

    <div class="dashboard-main-body">

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Utilisateurs</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Administration
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Utilisateurs</li>
            </ul>
        </div>

        {{-- ✅ Début de la rangée pour afficher le formulaire et le tableau côte à côte --}}
        <div class="row">

            {{-- 🧩 Colonne du formulaire --}}
            <div class="col-lg-4">
                <div class="card radius-12 overflow-hidden">
                    <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
                        <h6 class="text-white mb-0 fw-semibold d-flex align-items-center">
                            <span id="form-title">Ajouter un utilisateur</span>
                        </h6>
                    </div>
                    <div class="card-body p-24">
                        {{-- Formulaire --}}
                        <form id="user-form" action="{{ route('users.store') }}" method="POST">
                            @csrf

                            <div class="mb-20">
                                <label for="name"
                                    class="form-label fw-semibold text-primary-light text-sm mb-8 d-flex align-items-center">
                                    <iconify-icon icon="solar:user-outline" class="icon text-lg me-2"></iconify-icon>
                                    Nom complet <span class="text-danger-600 ms-1">*</span>
                                </label>
                                <input type="text" name="name" class="form-control radius-8 py-10" id="name"
                                    placeholder="Entrer le nom complet">
                            </div>

                            <div class="mb-20">
                                <label for="email"
                                    class="form-label fw-semibold text-primary-light text-sm mb-8 d-flex align-items-center">
                                    <iconify-icon icon="solar:letter-outline" class="icon text-lg me-2"></iconify-icon>
                                    Email <span class="text-danger-600 ms-1">*</span>
                                </label>
                                <input type="email" name="email" class="form-control radius-8 py-10" id="email"
                                    placeholder="exemple@email.com">
                            </div>

                            <div class="mb-20">
                                <label for="number"
                                    class="form-label fw-semibold text-primary-light text-sm mb-8 d-flex align-items-center">
                                    <iconify-icon icon="solar:phone-outline" class="icon text-lg me-2"></iconify-icon>
                                    Téléphone
                                </label>
                                <input type="tel" name="phone" class="form-control radius-8 py-10" id="number"
                                    placeholder="+33 6 12 34 56 78">
                            </div>

                            <div class="mb-24">
                                <label for="desig"
                                    class="form-label fw-semibold text-primary-light text-sm mb-8 d-flex align-items-center">
                                    <iconify-icon icon="solar:shield-user-outline" class="icon text-lg me-2"></iconify-icon>
                                    Rôle <span class="text-danger-600 ms-1">*</span>
                                </label>
                                <select class="form-control form-select radius-8 py-10" id="desig" name="role">
                                    <option value="">Sélectionner un rôle</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex gap-3">
                                <button type="button" id="btn-cancel-edit"
                                    class="btn btn-outline-danger flex-fill radius-8 py-10 d-flex align-items-center justify-content-center">
                                    Annuler
                                </button>
                                <button type="submit" id="btn-submit"
                                    class="btn btn-outline-primary flex-fill radius-8 py-10 d-flex align-items-center justify-content-center">
                                    Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- 🧩 Colonne du tableau --}}
            <div class="col-lg-8">
                <div class="card h-100 p-0 radius-12">
                    <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
                        <h6 class="text-white mb-0 fw-semibold d-flex align-items-center">
                            <span id="form-title">Liste des utilisateurs</span>
                        </h6>
                    </div>
                    <div
                        class="border-bottom bg-base px-24 py-16 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                        <div class="d-flex align-items-center flex-wrap gap-3">
                            <form method="GET" action="{{ route('users.index') }}"
                                class="d-flex align-items-center flex-wrap gap-3">
                                <input type="text" class="form-control form-control-sm w-auto py-6 radius-12 h-40-px"
                                    name="search" value="{{ request('search') }}" placeholder="Recherche...">
                                <select name="status" class="form-select form-select-sm w-auto py-6 radius-12 h-40-px">
                                    <option value="">Statut</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actif
                                    </option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactif
                                    </option>
                                </select>
                                <select name="role" class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                                    <option value="">Rôle</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                    class="btn btn-outline-primary radius-8 px-3 d-flex align-items-center">
                                    <iconify-icon icon="ion:search-outline" class="icon me-1"></iconify-icon>
                                    Filtrer
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary radius-8 px-3 d-flex align-items-center">
                                    <iconify-icon icon="ion:refresh-outline" class="icon me-1"></iconify-icon>
                                    Réinitialiser
                                </a>
                            </form>
                            <button id="deleteSelected" class="btn btn-danger btn-sm d-flex align-items-center d-none">
                                <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg me-1"></iconify-icon>
                                Supprimer la sélection
                            </button>
                        </div>

                    </div>
                    <div class="card-body p-24">
                        <div class="table-responsive scroll-sm">
                            <table class="table bordered-table sm-table mb-0" id="users-table">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <div class="d-flex align-items-center gap-10">
                                                N°
                                            </div>
                                        </th>
                                        <th scope="col">Nom complet</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Rôle</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-10">
                                                    <div class="form-check  style-check d-flex align-items-center">
                                                        <input
                                                            class="form-check-input radius-4 border border-neutral-400 user-select-checkbox"
                                                            type="checkbox" value="{{ $user->id }}">
                                                    </div>
                                                    {{ $users->firstItem() + $index }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <div class="flex-grow-1">
                                                        <span
                                                            class="text-md mb-0 fw-normal text-secondary-light">{{ $user->name }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span
                                                    class="text-md mb-0 fw-normal text-secondary-light">{{ $user->email }}</span>
                                            </td>
                                            <td>
                                                <span class="text-md mb-0 fw-normal text-secondary-light">
                                                    {{ $user->roles->first()->name ?? '-' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div
                                                    class="form-check form-switch d-flex justify-content-center align-items-center">
                                                    <input class="form-check-input toggle-status" type="checkbox" role="switch"
                                                        data-user-id="{{ $user->id }}" {{ $user->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-2 status-label-{{ $user->id }}">
                                                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                                    <a href="{{ route('users.show', $user->id) }}"
                                                        class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                                        <iconify-icon icon="majesticons:eye-line"
                                                            class="icon text-xl"></iconify-icon>
                                                    </a>
                                                    <button type="button"
                                                        class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle btn-edit-user"
                                                        data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}" data-phone="{{ $user->phone }}"
                                                        data-role-id="{{ optional($user->roles->first())->id }}">
                                                        <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                                    </button>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Supprimer cet utilisateur ?')"
                                                            class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                                            <iconify-icon icon="fluent:delete-24-regular"
                                                                class="menu-icon"></iconify-icon>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-3 px-3">
                            <div class="text-muted">
                                Affichage de {{ $users->firstItem() }} à {{ $users->lastItem() }} sur
                                {{ $users->total() }} entrées
                            </div>
                            <div>
                                {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                let isEditing = false;
                let originalAction = $('#user-form').attr('action');

                // Fonction pour basculer l'affichage du bouton de suppression
                function toggleDeleteButton() {
                    const checkedCount = $('.user-select-checkbox:checked').length;
                    const deleteButton = $('#deleteSelected');

                    if (checkedCount > 0) {
                        deleteButton.removeClass('d-none').addClass('d-flex');
                        deleteButton.html(`
                                <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg me-1"></iconify-icon>
                                Supprimer (${checkedCount})`);
                    } else {
                        deleteButton.removeClass('d-flex').addClass('d-none');
                    }
                }

                // Gestionnaire cases à cocher individuelles
                $(document).on('change', '.user-select-checkbox', function () {
                    toggleDeleteButton();
                });

                // Suppression multiple
                $('#deleteSelected').on('click', function () {
                    const selectedIds = $('.user-select-checkbox:checked').map(function () {
                        return $(this).val();
                    }).get();
                    if (selectedIds.length === 0) {
                        notifyJs('warning', 'Attention', 'Aucun utilisateur sélectionné.');
                        return;
                    }

                    if (!confirm(`Êtes-vous sûr de vouloir supprimer ${selectedIds.length} utilisateur(s) ?`)) {
                        return;
                    }

                    $.ajax({
                        url: '{{ route('users.bulk-delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: selectedIds
                        },
                        success: function (response) {
                            if (response.success) {
                                notifyJs('success', 'Succès', response.message ||
                                    'Utilisateurs supprimés avec succès');
                                setTimeout(() => window.location.reload(), 1500);
                            } else {
                                notifyJs('error', 'Erreur', response.message ||
                                    'Erreur lors de la suppression');
                            }
                        },
                        error: function (xhr) {
                            const errorMsg = xhr.responseJSON?.message ||
                                'Une erreur est survenue lors de la suppression';
                            notifyJs('error', 'Erreur', errorMsg);
                        }
                    });
                });

                // Édition d'un utilisateur
                $(document).on('click', '.btn-edit-user', function () {
                    const userId = $(this).data('id');
                    const userName = $(this).data('name');
                    const userEmail = $(this).data('email');
                    const userPhone = $(this).data('phone') || '';
                    const roleId = $(this).data('role-id') || '';

                    $('#name').val(userName);
                    $('#email').val(userEmail);
                    $('#number').val(userPhone);
                    $('#desig').val(roleId);

                    $('#user-form').attr('action', '{{ route('users.update', ':id') }}'.replace(':id',
                        userId));

                    // Ajouter ou mettre à jour le champ _method
                    if ($('#user-form input[name="_method"]').length) {
                        $('#user-form input[name="_method"]').val('PATCH');
                    } else {
                        $('#user-form').append('<input type="hidden" name="_method" value="PATCH">');
                    }

                    $('#btn-submit').text('Mise à jour');
                    $('#form-title').text('Modifier un utilisateur');
                    isEditing = true;
                });

                // Annuler l'édition
                $('#btn-cancel-edit').on('click', function () {
                    resetForm();
                });

                // Fonction pour réinitialiser le formulaire
                function resetForm() {
                    $('#user-form').attr('action', originalAction);
                    $('#user-form input[name="_method"]').remove();
                    $('#name, #email, #number').val('');
                    $('#desig').val('');
                    $('#btn-submit').text('Enregistrer');
                    $('#form-title').text('Ajouter un utilisateur');
                    isEditing = false;
                }

                // Initialiser l'état du bouton au chargement
                toggleDeleteButton();

                // Gestion du switch toggle status (empêcher la propagation)
                $(document).on('change', '.toggle-status', function (e) {
                    e.stopPropagation();

                    const userId = $(this).data('user-id');
                    const isChecked = $(this).is(':checked');
                    const statusLabel = $('.status-label-' + userId);
                    const checkbox = $(this);

                    $.ajax({
                        url: '{{ route('users.toggle-active', ':id') }}'.replace(':id', userId),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'PATCH'
                        },
                        success: function (response) {
                            // Mettre à jour le label
                            if (isChecked) {
                                statusLabel.text('Active').removeClass('text-danger').addClass(
                                    'text-success');
                            } else {
                                statusLabel.text('Inactive').removeClass('text-success').addClass(
                                    'text-danger');
                            }

                            // Afficher un message de succès
                            JsNotify('success', 'Succès', response.message ||
                                'Statut mis à jour avec succès');
                        },
                        error: function (xhr) {
                            // En cas d'erreur, remettre le switch à son état précédent
                            checkbox.prop('checked', !isChecked);

                            const errorMsg = xhr.responseJSON?.message ||
                                'Erreur lors de la mise à jour du statut';
                            notifyJs('error', 'Erreur', errorMsg);
                        }
                    });
                });
            });
        </script>

@endsection
