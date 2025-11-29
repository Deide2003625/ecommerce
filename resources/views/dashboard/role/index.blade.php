@extends('dashboard.master')
@section('title', 'Gestion des rôles')
@section('content')
    <div class="dashboard-main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card radius-12 overflow-hidden">
                    <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
                        <h5 class="text-white mb-0 fw-semibold d-flex align-items-center">
                            <span id="form-title">Ajouter un rôle</span>
                        </h5>
                    </div>

                    <div class="card-body p-24">
                        <form id="role-form" action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="mb-20">
                                <label for="name"
                                    class="form-label fw-semibold text-primary-light text-sm mb-8 d-flex align-items-center">
                                    Nom du rôle <span class="text-danger-600 ms-1">*</span>
                                </label>
                                <input type="text" name="name" class="form-control radius-8 py-10" id="name"
                                    placeholder="Entrer le nom du rôle">
                            </div>
                            <div class="mb-20">
                                <label for="description"
                                    class="form-label fw-semibold text-primary-light text-sm mb-8 d-flex align-items-center">
                                    Description
                                </label>
                                <textarea name="description" class="form-control radius-8 py-10" id="description"
                                    placeholder="Description du rôle"></textarea>
                            </div>
                            <div class="d-flex gap-3">
                                <button type="button" id="btn-cancel-edit"
                                    class="btn btn-outline-danger flex-fill radius-8 py-10 d-flex align-items-center justify-content-center">Annuler</button>
                                <button type="submit" id="btn-submit"
                                    class="btn btn-outline-primary flex-fill radius-8 py-10 d-flex align-items-center justify-content-center">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card h-100 p-0 radius-12">
                    <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
                        <h5 class="text-white mb-0 fw-semibold d-flex align-items-center">
                            <span id="form-title">Liste des rôles</span>
                        </h5>
                    </div>
                    <div class="card-body p-24">
                        <div class="table-responsive scroll-sm">
                            <table class="table bordered-table sm-table mb-0" id="roles-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col" style="max-width:370px; width:370px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">Description</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $index => $role)
                                        <tr>
                                            <td>{{ $roles->firstItem() + $index }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->description ?? '—' }}</td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                                    <a href="{{ route('roles.show', $role->id) }}"
                                                        class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                                        <iconify-icon icon="majesticons:eye-line"
                                                            class="icon text-xl"></iconify-icon>
                                                    </a>
                                                    <button type="button"
                                                        class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle btn-edit-role"
                                                        data-id="{{ $role->id }}" data-name="{{ $role->name }}"
                                                        data-description="{{ $role->description }}">
                                                        <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                                    </button>
                                                    <form class="form-delete-role d-inline" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button type="button" data-id="{{ $role->id }}"
                                                        class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle btn-delete-role">
                                                        <iconify-icon icon="fluent:delete-24-regular"
                                                            class="menu-icon"></iconify-icon>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3 px-3">
                            <div class="text-muted">
                                Affichage de {{ $roles->firstItem() }} à {{ $roles->lastItem() }} sur
                                {{ $roles->total() }}
                                rôles
                            </div>
                            <div>
                                {{ $roles->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Suppression AJAX
            $(document).on('click', '.btn-delete-role', function () {
                var btn = $(this);
                var roleId = btn.data('id');
                var form = btn.closest('td').find('form.form-delete-role');
                if (!confirm('Supprimer ce rôle ?')) return;
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        if (response.success) {
                            btn.closest('tr').fadeOut(400, function () {
                                $(this).remove();
                            });
                        } else {
                            alert(response.message || 'Erreur lors de la suppression');
                        }
                    },
                    error: function (xhr) {
                        alert(xhr.responseJSON?.message || 'Erreur serveur');
                    }
                });
            });

            // Edition AJAX inline
            let editing = false;
            let originalAction = $('#role-form').attr('action');
            $(document).on('click', '.btn-edit-role', function () {
                if (editing) return;
                editing = true;
                let btn = $(this);
                $('#name').val(btn.data('name'));
                $('#description').val(btn.data('description'));
                $('#role-form').attr('action', '{{ route('roles.update', ':id') }}'.replace(':id', btn.data('id')));
                if ($('#role-form input[name="_method"]').length) {
                    $('#role-form input[name="_method"]').val('PATCH');
                } else {
                    $('#role-form').append('<input type="hidden" name="_method" value="PATCH">');
                }
                $('#btn-submit').text('Modifier');
                $('#form-title').text('Modifier un rôle');
            });
            $('#btn-cancel-edit').on('click', function () {
                $('#role-form').attr('action', originalAction);
                $('#role-form input[name="_method"]').remove();
                $('#name, #description').val('');
                $('#btn-submit').text('Enregistrer');
                $('#form-title').text('Ajouter un rôle');
                editing = false;
            });
            // Soumission AJAX du formulaire
            $('#role-form').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    type: form.find('input[name="_method"]').val() === 'PATCH' ? 'POST' : 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        if (response.success) {
                            window.location.reload();
                        } else {
                            alert(response.message || 'Erreur lors de l\'enregistrement');
                        }
                    },
                    error: function (xhr) {
                        alert(xhr.responseJSON?.message || 'Erreur serveur');
                    }
                });
            });
        });
    </script>
@endpush
