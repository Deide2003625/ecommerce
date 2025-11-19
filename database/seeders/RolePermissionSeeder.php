<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
        {
            // Get roles
            $superAdminRole = Role::where('name', 'Super Admin')->first();
            $adminRole = Role::where('name', 'Admin')->first();
            $gestionnaireRole = Role::where('name', 'Gestionnaire')->first();
            $livreurRole = Role::where('name', 'Livreur')->first();
            $clientRole = Role::where('name', 'Client')->first();

            // Get all permissions
            $allPermissions = Permission::all();

            // 1. Super Admin - All permissions
            $superAdminRole->syncPermissions($allPermissions);

            // 2. Admin - Permissions marketing + gestionnaire
            $adminPermissions = Permission::whereIn('name', [
                // Marketing & Content
                'newsletters.voir',
                'newsletters.creer',
                'newsletters.envoyer',
                'avis.voir',
                'avis.approuver',
                'avis.rejeter',
                'commentaires.voir',
                'commentaires.approuver',
                'commentaires.rejeter',
                'articles_blog.voir',
                'articles_blog.creer',
                'articles_blog.modifier',
                'articles_blog.supprimer',
                'articles_blog.publier',
                'articles_blog.moderer',
                'bannieres.voir',
                'bannieres.creer',
                'bannieres.modifier',
                'bannieres.supprimer',

                // Permissions du gestionnaire
                'produits.voir',
                'produits.creer',
                'produits.modifier',
                'produits.supprimer',
                'produits.activer_desactiver',
                'stock.voir',
                'stock.modifier',
                'stock.gerer',
                'categories.voir',
                'categories.creer',
                'categories.modifier',
                'categories.supprimer',
                'sous_categories.voir',
                'sous_categories.creer',
                'sous_categories.modifier',
                'sous_categories.supprimer',
                'commandes.voir',
                'commandes.creer',
                'commandes.modifier',
                'commandes.traiter',
                'commandes.rembourser',
                'commandes.exporter',
                'coupons.voir',
                'coupons.creer',
                'coupons.modifier',
                'coupons.supprimer',
                'livraisons.voir',
                'livraisons.suivre',
                'livraisons.modifier',
                'transactions.voir',
                'transactions.traiter',
                'transactions.rembourser',
                'factures.voir',
                'factures.generer',
                'factures.telecharger',
                'clients.voir',
                'clients.creer',
                'clients.modifier',
                'clients.bloquer',
                'adresses.voir',
                'adresses.creer',
                'adresses.modifier',
                'statistiques.voir',
                'rapports.generer',
                'parametres.voir',
                'parametres.modifier',
            ])->get();
            $adminRole->syncPermissions($adminPermissions);

            // 3. Gestionnaire - Permissions boutique
            $gestionnairePermissions = Permission::whereIn('name', [
                'produits.voir',
                'produits.creer',
                'produits.modifier',
                'produits.supprimer',
                'produits.activer_desactiver',
                'stock.voir',
                'stock.modifier',
                'stock.gerer',
                'categories.voir',
                'categories.creer',
                'categories.modifier',
                'categories.supprimer',
                'sous_categories.voir',
                'sous_categories.creer',
                'sous_categories.modifier',
                'sous_categories.supprimer',
                'commandes.voir',
                'commandes.creer',
                'commandes.modifier',
                'commandes.traiter',
                'commandes.rembourser',
                'commandes.exporter',
                'coupons.voir',
                'coupons.creer',
                'coupons.modifier',
                'coupons.supprimer',
                'livraisons.voir',
                'livraisons.suivre',
                'livraisons.modifier',
                'transactions.voir',
                'transactions.traiter',
                'transactions.rembourser',
                'factures.voir',
                'factures.generer',
                'factures.telecharger',
                'clients.voir',
                'clients.creer',
                'clients.modifier',
                'clients.bloquer',
                'adresses.voir',
                'adresses.creer',
                'adresses.modifier',
                'statistiques.voir',
                'rapports.generer',
                'parametres.voir',
                'parametres.modifier',
            ])->get();
            $gestionnaireRole->syncPermissions($gestionnairePermissions);

            // 4. Livreur - Permissions livraison
            $livreurPermissions = Permission::whereIn('name', [
                'livraisons.voir',
                'livraisons.suivre',
                'livraisons.modifier',
                'commandes.voir',
                'produits.voir',
                'categories.voir',
                'sous_categories.voir',
                'adresses.voir',
            ])->get();
            $livreurRole->syncPermissions($livreurPermissions);

            // 5. Client - Permissions basiques (si besoin)
            $clientPermissions = Permission::whereIn('name', [
                'produits.voir',
                'categories.voir',
                'sous_categories.voir',
                'commandes.creer',
                'commandes.voir',
                'commandes.annuler',
                'commandes.payer',
                'livraisons.suivre',
                'clients.modifier',
                'adresses.creer',
                'adresses.modifier',
                'adresses.voir',
                'avis.creer',
                'commentaires.creer',
            ])->get();
            $clientRole->syncPermissions($clientPermissions);
        }
}
