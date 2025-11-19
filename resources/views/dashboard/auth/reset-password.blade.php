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
                    <h4 class="mb-12">Réinitialiser le mot de passe</h4>
                    <p class="mb-32 text-secondary-light text-lg">Définissez un nouveau mot de passe pour votre compte.</p>
                </div>
                <form id="reset-password-form">
                    @csrf
                    <input type="hidden" name="email" value="{{ $request->email ?? old('email') }}">
                    <input type="hidden" name="token" value="{{ $request->token }}">
                    <div id="reset-password-text" class="mb-16"></div>
                    <div class="position-relative mb-20">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12" id="new-password"
                                placeholder="Nouveau mot de passe" required>
                        </div>
                    </div>
                    <div class="position-relative mb-20">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" name="password_confirmation" class="form-control h-56-px bg-neutral-50 radius-12"
                                id="confirm-password" placeholder="Confirmer le mot de passe" required>
                        </div>
                    </div>
                    <button type="submit" id="reset-password-btn" class="btn btn-outline-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">
                        Réinitialiser le mot de passe
                    </button>
                </form>
                <div class="mt-32 text-center text-sm">
              password-reset-message      <a href="{{ route('login') }}" class="text-primary-600 fw-semibold">Retour à la connexion</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#reset-password-form').on('submit', function(e) {
                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    url: "{{ route('password.store') }}",
                    type: "POST",
                    data: data,
                    beforeSend: function() {
                        $('#reset-password-btn').prop('disabled', true).html('<i class="ri-loader-2-line ri-spin"></i> Changement en cours...');
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#reset-password-btn').prop('disabled', false).html('<i class="ri-check-line"></i> Mot de passe changé !');
                            window.location.href = response.redirect;
                        } else {
                            $('#reset-password-btn').prop('disabled', false).html('Réinitialiser le mot de passe');
                            $('#reset-password-text').html('<span class="text-danger">Une erreur s\'est produite. Veuillez réessayer.</span>');
                        }
                    },
                    error: function(xhr) {
                        console.log('Une erreur s\'est produite. Veuillez réessayer.');
                    }
                });
            });
        });
    </script>

@endpush
