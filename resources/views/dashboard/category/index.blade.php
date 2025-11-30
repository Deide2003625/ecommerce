@extends('dashboard.master')
@section('title', 'Gestion des catégories')

@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Catégories</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="carbon:categories" class="icon text-lg"></iconify-icon>
                        Catalogue
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Catégories</li>
            </ul>
        </div>
        <div class="row">
            {{-- Formulaire à gauche --}}
            <div class="col-lg-4">
                <div class="card radius-12 overflow-hidden">
                    <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
                        <h6 class="text-white mb-0 fw-semibold d-flex align-items-center">
                            <span id="form-title">Ajouter une catégorie</span>
                        </h6>
                    </div>
                    <div class="card-body p-24">
                        <form id="category-form" action="{{ route('categories.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-20">
                                <label for="name"
                                    class="form-label fw-semibold text-primary-light text-sm mb-8 d-flex align-items-center">
                                    Nom <span class="text-danger-600 ms-1">*</span>
                                </label>
                                <input type="text" name="nom" class="form-control radius-8 py-10" id="nom"
                                    placeholder="Nom de la catégorie">
                            </div>
                            <div class="mb-20">
                                <label for="description"
                                    class="form-label fw-semibold text-primary-light text-sm mb-8 d-flex align-items-center">
                                    Description
                                </label>
                                <textarea name="description" class="form-control radius-8 py-10" id="description"
                                    placeholder="Description"></textarea>
                            </div>
                            <div class="mb-20">
                                <label for="media"
                                    class="form-label fw-semibold text-primary-light text-sm mb-8 d-flex align-items-center">
                                    Image
                                </label>
                                <input type="file" name="media" class="form-control radius-8 py-10" id="media"
                                    accept="image/*">
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
            {{-- Tableau à droite --}}
            <div class="col-lg-8">
                <div class="card h-100 p-0 radius-12">
                    <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
                        <h6 class="text-white mb-0 fw-semibold d-flex align-items-center">
                            <span id="form-title">Liste des catégories</span>
                        </h6>
                    </div>
                    <div class="card-body p-24">
                        <div class="table-responsive scroll-sm">
                            <table class="table bordered-table sm-table mb-0" id="categories-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $index => $category)
                                        <tr>
                                            <td>{{ $categories->firstItem() + $index }}</td>
                                            <td>
                                                @if($category->getFirstMediaUrl('categories'))
                                                    <img src="{{ $category->getFirstMediaUrl('categories') }}" alt="Image"
                                                        style="width:40px;height:40px;object-fit:cover;border-radius:8px;">
                                                @else
                                                    —
                                                @endif
                                            </td>
                                            <td>{{ $category->nom }}</td>
                                            <td>{{ $category->description ?? '—' }}</td>

                                            <td class="text-center">
                                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                                    <a href="{{ route('categories.show', $category->id) }}"
                                                        class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                                        <iconify-icon icon="majesticons:eye-line"
                                                            class="icon text-xl"></iconify-icon>
                                                    </a>
                                                    <button type="button"
                                                        class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle btn-edit-category"
                                                        data-id="{{ $category->id }}" data-nom="{{ $category->nom }}"
                                                        data-description="{{ $category->description }}">
                                                        <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                                    </button>
                                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Supprimer cette catégorie ?')"
                                                            class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                                            <iconify-icon icon="fluent:delete-24-regular"
                                                                class="menu-icon"></iconify-icon>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Aucune données enregistré</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3 px-3">
                            <div class="text-muted">
                                Affichage de {{ $categories->firstItem() }} à {{ $categories->lastItem() }} sur
                                {{ $categories->total() }} catégories
                            </div>
                            <div>
                                {{ $categories->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $(document).ready(function () {
                let isEditing = false;
                let originalAction = $('#category-form').attr('action');

                // Édition d'une catégorie
                $(document).on('click', '.btn-edit-category', function () {
                    const categoryId = $(this).data('id');
                    const categoryNom = $(this).data('nom');
                    const categoryDescription = $(this).data('description');

                    $('#nom').val(categoryNom);
                    $('#description').val(categoryDescription);
                    $('#category-form').attr('action', '{{ route('categories.update', ':id') }}'.replace(':id', categoryId));

                    // Ajouter ou mettre à jour le champ _method
                    if ($('#category-form input[name="_method"]').length) {
                        $('#category-form input[name="_method"]').val('PATCH');
                    } else {
                        $('#category-form').append('<input type="hidden" name="_method" value="PATCH">');
                    }

                    $('#btn-submit').text('Mise à jour');
                    $('#form-title').text('Modifier une catégorie');
                    isEditing = true;
                });

                // Annuler l'édition
                $('#btn-cancel-edit').on('click', function () {
                    resetForm();
                });

                // Fonction pour réinitialiser le formulaire
                function resetForm() {
                    $('#category-form').attr('action', originalAction);
                    $('#category-form input[name="_method"]').remove();
                    $('#nom, #description, #media').val('');
                    $('#btn-submit').text('Enregistrer');
                    $('#form-title').text('Ajouter une catégorie');
                    isEditing = false;
                }

                // Soumission AJAX du formulaire
                $('#category-form').on('submit', function (e) {
                    e.preventDefault();
                    const form = $(this)[0];
                    const formData = new FormData(form);
                    const url = $(this).attr('action');
                    let method = $(this).find('input[name="_method"]').val() || 'POST';

                    formData.append('_token', '{{ csrf_token() }}');
                    if (method === 'PATCH') {
                        formData.append('_method', 'PATCH');
                        method = 'POST'; // AJAX doit rester POST, Laravel détecte _method
                    }

                    $.ajax({
                        url: url,
                        type: method,
                        data: formData,
                        processData: false,
                        contentType: false,
                        complete: function () {
                            window.location.reload();
                        },
                        error: function (xhr) {
                            const errorMsg = xhr.responseJSON?.message || 'Erreur lors de l\'enregistrement';
                            notifyJs('error', 'Erreur', errorMsg);
                        }
                    });
                });

            });
        </script>
    @endpush
@endsection
