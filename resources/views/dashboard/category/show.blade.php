@extends('dashboard.master')
@section('title', 'Détail catégorie')

@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Catégorie</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('categories.index') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="carbon:categories" class="icon text-lg"></iconify-icon>
                        Catalogue
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Détail catégorie</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card radius-12 overflow-hidden mb-3">
                    <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
                        <h6 class="text-white mb-0 fw-semibold d-flex align-items-center">
                            Détail de la catégorie
                        </h6>
                    </div>
                    <div class="card-body p-24">
                        <!-- Formulaire ajout sous-catégorie -->
                        <form id="add-subcategory-form" action="{{ route('categories.subcategories.store', $category) }}" method="POST"
                            class="mb-4 d-flex flex-column gap-2">
                            @csrf
                            <div class="mb-20">
                                <label for="noms"
                                    class="form-label fw-semibold text-primary-light text-sm mb-8 d-flex align-items-center">
                                    Noms des sous-catégories <span class="text-danger-600 ms-1">*</span>
                                </label>
                                <textarea name="noms" class="form-control radius-8 py-10" id="noms" rows="4" placeholder="Une sous-catégorie par ligne"></textarea>
                            </div>
                            <button type="submit" class="btn btn-outline-primary radius-8 px-4">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card radius-12 overflow-hidden mb-3">
                    <div class="card-header bg-primary-600 py-16 px-24 border-bottom-0">
                        <h6 class="text-white mb-0 fw-semibold d-flex align-items-center">
                            Liste des sous-catégories
                        </h6>
                    </div>
                    <div class="card-body p-24">
                        <div class="table-responsive scroll-sm">
                            <table class="table bordered-table sm-table mb-0" id="subcategories-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($category->subCategories as $index => $subCategory)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $subCategory->nom }}</td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                                    <form action="{{ route('categories.subcategories.destroy', [$category->id, $subCategory->id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Supprimer cette sous-catégorie ?')"
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
                                            <td colspan="5" class="text-center">Aucune sous-catégorie enregistrée</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
