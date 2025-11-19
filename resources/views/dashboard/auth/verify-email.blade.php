@extends('dashboard.auth.master')

@section('title', 'Vérification de l\'email - ' . config('app.name'))

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
                <h4 class="mb-12">Vérification de l'email</h4>
                <p class="mb-32 text-secondary-light text-lg">
                    Un lien de vérification a été envoyé à votre adresse e-mail.<br>
                    Veuillez vérifier votre boîte de réception et cliquer sur le lien pour activer votre compte.<br>
                    Si vous n'avez pas reçu l'e-mail, cliquez ci-dessous pour en recevoir un nouveau.
                </p>
            </div>
            <form action="#" method="POST">
                <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">
                    Renvoyer l'e-mail de vérification
                </button>
            </form>
            <div class="mt-32 text-center text-sm">
                <a href="login.html" class="text-primary-600 fw-semibold">Retour à la connexion</a>
            </div>
        </div>
    </div>
</section>
@endsection
