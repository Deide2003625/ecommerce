@extends('dashboard.auth.master')

@section('title', 'Mot de passe oublié - ' . config('app.name'))

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
                    <h4 class="mb-12">Mot de passe oublié ?</h4>
                    <p class="mb-32 text-secondary-light text-lg" id="forgot-password-text">Entrez votre adresse e-mail pour recevoir un lien de
                        réinitialisation.</p>
                </div>
                <form id="forgot-password">
                    @csrf
                    <div class="icon-field mb-16">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="E-mail"
                            required>
                    </div>
                    <button type="submit" id="forgot-password-btn" class="btn btn-outline-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">
                        Envoyer le lien de réinitialisation
                    </button>
                </form=>
                <div class="mt-32 text-center text-sm">
                    <a href="{{ route('login') }}" class="text-primary-600 fw-semibold">Retour à la connexion</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#forgot-password').on('submit', function(e) {
                e.preventDefault();
                const email = $(this).find('input[type="email"]').val();

                $.ajax({
                    url: "{{ route('password.email') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: email
                    },
                    beforeSend: function() {
                        $('#forgot-password-btn').prop('disabled', true).html('<i class="ri-loader-2-line ri-spin"></i> Envoi en cours...');
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#forgot-password-text').html('<span class="text-success">Un lien de réinitialisation a été envoyé à votre adresse e-mail.</span>');
                            $('#forgot-password-btn').prop('disabled', false).html('<i class="ri-check-line"></i> Lien envoyé !');
                            $('#forgot-password')[0].reset();
                        } else {
                            $('#forgot-password-text').html('<span class="text-danger">Une erreur s\'est produite. Veuillez réessayer.</span>');
                            $('#forgot-password-btn').prop('disabled', false).html('Envoyer le lien de réinitialisation');
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

