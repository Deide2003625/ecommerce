@extends('dashboard.auth.master')

@section('title', 'Confirmer le mot de passe - ' . config('app.name'))

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
                    <h4 class="mb-12">Confirmer le mot de passe</h4>
                    <p class="mb-32 text-secondary-light text-lg">
                        Veuillez confirmer votre mot de passe avant de continuer.
                    </p>
                </div>
                <form action="#" method="POST">
                    <div class="position-relative mb-20">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" class="form-control h-56-px bg-neutral-50 radius-12"
                                placeholder="Mot de passe" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">
                        Confirmer
                    </button>
                </form>
                <div class="mt-32 text-center text-sm">
                    <a href="forgot-password.html" class="text-primary-600 fw-semibold">Mot de passe oublié ?</a>
                </div>
            </div>
        </div>
    </section>
@endsection

