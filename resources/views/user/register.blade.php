@extends('dashboard.master')
@section('title', 'Dashboard')

@section('content')

<div class="dashboard-main-body">
    
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Users Grid</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Users Grid</li>
        </ul>
    </div>
                             
    {{-- ✅ Début de la rangée pour afficher le tableau et le formulaire côte à côte --}}
    <div class="row">

        {{-- 🧩 Colonne du tableau --}}
        <div class="col-lg-8">
             
       
        <div class="card h-100 p-0 radius-12">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
                    <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        
                    </select>
                    <form class="navbar-search">
                        <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                        <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                    </form>

                    <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                        <option>Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>

                    
                    <button id="deleteSelected" class="btn btn-danger btn-sm d-flex align-items-center d-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
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
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input radius-4 border input-form-dark" type="checkbox" id="selectAll">
                                </div>
                                S.L
                            </div>
                          </th>
                          <th scope="col">Join Date</th>
                          <th scope="col">Nom&Prenom</th>
                          <th scope="col">Email</th>
                          <th scope="col">Designation</th>
                          <th scope="col" class="text-center">Status</th>
                          <th scope="col" class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-10">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400 user-checkbox" type="checkbox" value="{{ $user->id }}">
                                    </div>
                                   {{ $user->id }}
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                          <td>
                            <div class="d-flex align-items-center">
                              
                              <div class="flex-grow-1">
                                <span class="text-md mb-0 fw-normal text-secondary-light">{{ $user->name}}</span>
                              </div>
                            </div>
                          </td>
                          <td><span class="text-md mb-0 fw-normal text-secondary-light">{{ $user->email }}</span></td>
                          <td>
                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                {{ $user->roles->first()->name ?? '-' }}
                            </span>
                          </td>
                          <td class="text-center">
                            <form action="{{ route('user.toggle-active', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                @if($user->is_active)
                                    <button type="submit" class="bg-success-focus text-success-600 border border-success-main px-24 py-4 radius-4 fw-medium text-sm">
                                        Active
                                    </button>
                                @else
                                    <button type="submit" class="bg-danger-focus text-danger-600 border border-danger-main px-24 py-4 radius-4 fw-medium text-sm">
                                        Inactive
                                    </button>
                                @endif
                            </form>
                          </td>
                          <td class="text-center"> 
                            <div class="d-flex align-items-center gap-10 justify-content-center">
                                <a href="{{ route('user.show', $user->id) }}" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                </a>
                                <button type="button" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle btn-edit-user"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-phone="{{ $user->phone }}"
                                        data-role-id="{{ optional($user->roles->first())->id }}"> 
                                    <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                </button>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Supprimer cet utilisateur ?')" class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"> 
                                        <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
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
                        Affichage de {{ $users->firstItem() }} à {{ $users->lastItem() }} sur {{ $users->total() }} entrées
                    </div>
                    <div>
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>

            </div>
        </div>
    
        </div>

        {{--  Colonne du formulaire --}}
        <div class="col-lg-4">
            <div class="card h-100 p-0 radius-12">
                <div class="card-body p-24">
                    <div class="row justify-content-center">
                        <div class="col-xxl-10 col-xl-12 col-lg-12">
                            <div class="card border">
                                <div class="card-body">
                                    <h6 class="text-md text-primary-light mb-16">Profile Image</h6>

                                    {{-- Upload image --}}
                                    <div class="mb-24 mt-16">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" hidden>
                                                <label for="imageUpload" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                    <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                                </label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview"></div>
                                            </div>
                                        </div>
                                    </div>
                                       
                                    {{-- Formulaire --}}
                                    <form id="user-form" action="{{ route('insert') }}" method="POST">
                                         @csrf
                                        <div class="mb-20">
                                            <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Nom complet <span class="text-danger-600">*</span></label>
                                            <input type="text" name="name" class="form-control radius-8" id="name" placeholder="Entrer votre nom complet">
                                        </div>
                                        <div class="mb-20">
                                            <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                                            <input type="email" name="email" class="form-control radius-8" id="email" placeholder="Enter email address">
                                        </div>
                                        <div class="mb-20">
                                            <label for="number"  class="form-label fw-semibold text-primary-light text-sm mb-8">Telephone</label>
                                            <input type="number" name="phone" class="form-control radius-8" id="number" placeholder="Enter phone number">
                                        </div>
                                       
                                        <div class="mb-20">
                                            <label for="desig" class="form-label fw-semibold text-primary-light text-sm mb-8">Designation <span class="text-danger-600">*</span> </label>
                                            <select class="form-control radius-8 form-select" id="desig" name="role">
                                                <option value="">Choisir un rôle</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="d-flex align-items-center justify-content-center gap-3">
                                            <button type="button" id="btn-cancel-edit" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-20 py-8 radius-8"> 
                                                Cancel
                                            </button>
                                            <button type="submit" id="btn-submit" class="btn btn-primary border border-primary-600 text-md px-20 py-8 radius-8"> 
                                                Save
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> 

<script>
    // Fonction pour gérer l'affichage du bouton de suppression
    function toggleDeleteButton() {
        const checkboxes = document.querySelectorAll('.user-checkbox:checked');
        const deleteButton = document.getElementById('deleteSelected');
        
        if (deleteButton) {
            if (checkboxes.length > 0) {
                // Afficher le bouton avec l'effet de fondu
                deleteButton.classList.remove('d-none');
                deleteButton.classList.add('d-flex');
                
                // Mettre à jour le texte avec le nombre d'éléments sélectionnés
                deleteButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Supprimer (${checkboxes.length})`;
            } else {
                // Cacher le bouton
                deleteButton.classList.remove('d-flex');
                deleteButton.classList.add('d-none');
                
                // Réinitialiser le texte
                deleteButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Supprimer la sélection`;
            }
            
            console.log('Bouton de suppression - État:', checkboxes.length > 0 ? 'visible' : 'caché');
        }
    }
    
    // Fonction pour gérer la suppression des éléments sélectionnés
    function deleteSelectedItems() {
        const checkboxes = document.querySelectorAll('.user-checkbox:checked');
        if (checkboxes.length === 0) {
            alert('Aucun utilisateur sélectionné.');
            return;
        }

        if (confirm(`Êtes-vous sûr de vouloir supprimer ${checkboxes.length} utilisateur(s) ?`)) {
            // Logique de suppression ici
            console.log('Suppression des utilisateurs sélectionnés');
        }
    }
    
    // Attendre que le DOM soit chargé
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM chargé, initialisation des écouteurs d\'événements');
        
        // Ajouter l'écouteur d'événement au bouton de suppression
        const deleteButton = document.getElementById('deleteSelected');
        if (deleteButton) {
            deleteButton.addEventListener('click', deleteSelectedItems);
        }
        
        // Gestionnaire d'événement pour la case à cocher "Tout sélectionner"
        const selectAllCheckbox = document.getElementById('selectAll');
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.user-checkbox');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                toggleDeleteButton();
            });
        }
        
        // Gestionnaire d'événement pour les cases à cocher individuelles
        const checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', toggleDeleteButton);
            console.log('Écouteur d\'événement ajouté à la case à cocher');
        });
        
        // Initialiser l'état du bouton au chargement
        toggleDeleteButton();
        
        // Vérifier si Bootstrap est chargé
        if (typeof bootstrap !== 'undefined') {
            console.log('Bootstrap est chargé');
        } else {
            console.warn('Bootstrap n\'est pas chargé correctement');
        }
    });
    
    function deleteSelectedItems() {
        const checkboxes = document.querySelectorAll('.user-checkbox:checked');
        if (checkboxes.length === 0) {
            alert('Aucun utilisateur sélectionné.');
            return;
        }

        if (!confirm('Êtes-vous sûr de vouloir supprimer ' + checkboxes.length + ' utilisateur(s) ?')) {
            return;
        }

        // Créer un tableau avec les IDs sélectionnés
        const ids = Array.from(checkboxes).map(checkbox => checkbox.value);
        
        console.log('IDs sélectionnés :', ids);
        
        // Créer un objet FormData pour envoyer les données
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        ids.forEach(id => {
            formData.append('ids[]', id);
        });

        // Afficher les données du formulaire dans la console
        const formDataObj = {};
        for (let [key, value] of formData.entries()) {
            formDataObj[key] = value;
        }
        console.log('Données du formulaire :', formDataObj);
        
        // URL de l'API
        const url = '{{ route("user.bulk-destroy") }}';
        console.log('URL de suppression :', url);
        
        // Options de la requête
        const options = {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(formData)
        };
        
        // Envoyer la requête
        fetch(url, options)
            .then(response => {
                console.log('Statut de la réponse :', response.status);
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.message || 'Erreur lors de la suppression');
                    }).catch(() => {
                        throw new Error('Erreur lors de la suppression (statut ' + response.status + ')');
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Réponse du serveur :', data);
                if (data.success) {
                    // Afficher un message de succès et recharger la page
                    alert(data.message || 'Utilisateurs supprimés avec succès');
                    window.location.reload();
                } else {
                    throw new Error(data.message || 'Erreur lors de la suppression');
                }
            })
            .catch(error => {
                console.error('Erreur lors de la suppression :', error);
                alert('Erreur : ' + (error.message || 'Une erreur est survenue lors de la suppression des utilisateurs.'));
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.btn-edit-user');
        const form = document.getElementById('user-form');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('number');
        const roleSelect = document.getElementById('desig');
        const btnSubmit = document.getElementById('btn-submit');
        const btnCancelEdit = document.getElementById('btn-cancel-edit');

        let isEditing = false;
        let originalAction = form.getAttribute('action');

        editButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const email = this.dataset.email;
                const phone = this.dataset.phone || '';
                const roleId = this.dataset.roleId || '';

                nameInput.value = name;
                emailInput.value = email;
                phoneInput.value = phone;

                if (roleId) {
                    roleSelect.value = roleId;
                } else {
                    roleSelect.value = '';
                }

                form.setAttribute('action', '{{ url('user') }}/' + id);

                let methodInput = form.querySelector('input[name="_method"]');
                if (!methodInput) {
                    methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    form.appendChild(methodInput);
                }
                methodInput.value = 'PATCH';

                btnSubmit.textContent = 'Update';
                isEditing = true;
            });
        });

        btnCancelEdit.addEventListener('click', function () {
            if (!isEditing) {
                nameInput.value = '';
                emailInput.value = '';
                phoneInput.value = '';
                roleSelect.value = '';
                return;
            }

            form.setAttribute('action', originalAction);
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) {
                methodInput.remove();
            }

            nameInput.value = '';
            emailInput.value = '';
            phoneInput.value = '';
            roleSelect.value = '';

            btnSubmit.textContent = 'Save';
            isEditing = false;
        });
    });
</script>

@endsection
