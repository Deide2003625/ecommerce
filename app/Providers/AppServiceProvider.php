<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        // Observer pour insérer inserted_by et updated_by
        $models = [
            \App\Models\Categorie::class,
            \App\Models\SousCategorie::class,
            \App\Models\ArticleBlog::class,
            \App\Models\ArticleCommande::class,
            \App\Models\Avis::class,
            \App\Models\Banniere::class,
            \App\Models\Commande::class,
            \App\Models\CommentaireBlog::class,
            \App\Models\Contact::class,
            \App\Models\Coupon::class,
            \App\Models\Facture::class,
            \App\Models\Favori::class,
            \App\Models\Livraison::class,
            \App\Models\Livreur::class,
            \App\Models\MethodePaiement::class,
            \App\Models\Newsletter::class,
            \App\Models\OptionProduit::class,
            \App\Models\Parametre::class,
            \App\Models\Permission::class,
            \App\Models\Produit::class,
            \App\Models\RapportVentes::class,
            \App\Models\Role::class,
            \App\Models\RoleHasPermission::class,
            \App\Models\SelectionOption::class,
            \App\Models\StatistiqueVisiteur::class,
            \App\Models\Transaction::class,
            \App\Models\User::class,
            \App\Models\UserData::class,
            \App\Models\UtilisationCoupon::class,
            \App\Models\ValeurOption::class,
            \App\Models\VarianteProduit::class,
        ];
        foreach ($models as $model) {
            $model::observe(\App\Observers\UserActionObserver::class);
            $model::observe(\App\Observers\UserDoActionObserver::class);
        }
    }
}
