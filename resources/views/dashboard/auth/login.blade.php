@extends('dashboard.auth.master')

@section('title', 'Login - ' . config('app.name'))

@section('content')
    <section class="auth bg-base d-flex flex-wrap">
        <div class="auth-left d-lg-block d-none">
            <div class="d-flex align-items-center flex-column h-100 justify-content-center">
                <img src="images/auth/auth-img.png" alt="">
            </div>
        </div>
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <a href="{{ route('dashboard') }}" class="mb-40 max-w-290-px">
                        <img src="images/logo.png" alt="">
                    </a>
                    <h4 class="mb-12">Connectez-vous à votre compte</h4>
                    <p class="mb-32 text-secondary-light text-lg">Bon retour ! Veuillez entrer vos informations</p>
                </div>
                <form id="login-form">
                    @csrf
                    <div class="icon-field mb-16">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" name="email" id="email"
                            class="form-control h-56-px bg-neutral-50 radius-12 @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="E-mail">
                        @error('email')
                            <span class="invalid-feedback invalid-feedback-email" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div id="password"></div>

                    <div class="">
                        <div class="d-flex justify-content-between gap-2">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input border border-neutral-300" type="checkbox" value=""
                                    id="remeber">
                                <label class="form-check-label" for="remeber">Se souvenir de moi</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-primary-600 fw-medium">Mot de passe oublié
                                ?</a>
                        </div>
                    </div>

                    <button type="submit" id="login-btn"
                        class="btn btn-outline-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">
                        Se connecter
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#email').on('input', function() {
                var email = $(this).val();
                $.ajax({
                    url: '{{ route('check.email') }}',
                    type: 'GET',
                    data: {
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#password').empty(); // Clear previous content

                        if (response.success && response.password !== null) {
                            $('#password').append(
                                `<div class="position-relative mb-20" id="password-field">
                                    <div class="icon-field">
                                        <span class="icon top-50 translate-middle-y">
                                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                        </span>
                                        <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password"
                                            placeholder="Mot de passe">
                                    </div>
                                    <span
                                        class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                        data-target="#your-password"></span>
                                </div>`
                            );
                        } else if (response.success == true && response.password === null) {
                            $('#password').append(
                                `<div class="position-relative mb-20" id="password-field">
                                    <div class="icon-field">
                                        <span class="icon top-50 translate-middle-y">
                                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                        </span>
                                        <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password"
                                            placeholder="Mot de passe">
                                    </div>
                                    <span
                                        class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                        data-target="#your-password"></span>
                                </div>
                                <div class="position-relative mb-20" id="password-confirm-field">
                                    <div class="icon-field">
                                        <span class="icon top-50 translate-middle-y">
                                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                        </span>
                                        <input type="password" name="password_confirmation" class="form-control h-56-px bg-neutral-50 radius-12" id="confirm-password"
                                            placeholder="Confirmer le mot de passe">
                                    </div>
                                    <span
                                        class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                        data-target="#confirm-password"></span>
                                </div>`
                            );
                        } else {
                            $('.invalid-feedback-email').text('Email non trouvé.');
                        }
                    },
                    error: function(xhr) {
                        console.log('Error checking email.');
                    }
                });
            });

            // Handle form submission
            $('#login-form').on('submit', function(event) {
                event.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    url: '{{ route('login') }}',
                    type: 'POST',
                    data: data,
                    beforeSend: function() {
                        $('#login-btn').prop('disabled', true).html(
                            '<i class="ri-loader-2-line ri-spin"></i> Connexion en cours ...'
                        );
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#login-btn').prop('disabled', false).html(
                                '<i class="ri-check-line"></i> Connexion réussie !');
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr) {
                        $('#login-btn').prop('disabled', false).text('Se connecter');
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            // Handle validation errors
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('.invalid-feedback-' + key).text(value[0]);
                            });
                        }
                    }
                });
            });

            // Toggle password visibility
            $(document).on('click', '.toggle-password', function() {
                const target = $(this).data('target');
                const $passwordInput = $(target);
                const type = $passwordInput.attr('type') === 'password' ? 'text' : 'password';
                $passwordInput.attr('type', type);

                // Change eye icon
                $(this).toggleClass('ri-eye-line ri-eye-off-line');
            });
        });
    </script>
@endpush
