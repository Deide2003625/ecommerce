<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Permissions Utilisateurs (CRUD séparé)
        $userPermissions = [
            'utilisateurs.voir',
            'utilisateurs.creer',
            'utilisateurs.modifier',
            'utilisateurs.supprimer',
            'utilisateurs.impersonifier'
        ];

        // 2. Permissions Rôles (CRUD séparé)
        $rolePermissions = [
            'roles.voir',
            'roles.creer',
            'roles.modifier',
            'roles.supprimer',
            'roles.assigner'
        ];

        // 3. Permissions Permissions (CRUD séparé)
        $permissionPermissions = [
            'permissions.voir',
            'permissions.creer',
            'permissions.modifier',
            'permissions.supprimer',
            'permissions.assigner'
        ];

        // 4. Permissions Produits (CRUD séparé)
        $productPermissions = [
            'produits.voir',
            'produits.creer',
            'produits.modifier',
            'produits.supprimer',
            'produits.activer_desactiver'
        ];

        // 5. Permissions Catégories (CRUD séparé)
        $categoryPermissions = [
            'categories.voir',
            'categories.creer',
            'categories.modifier',
            'categories.supprimer'
        ];

        // 6. Permissions Sous-catégories (CRUD séparé)
        $subcategoryPermissions = [
            'sous_categories.voir',
            'sous_categories.creer',
            'sous_categories.modifier',
            'sous_categories.supprimer'
        ];

        // 7. Permissions Stock (CRUD séparé)
        $stockPermissions = [
            'stock.voir',
            'stock.modifier',
            'stock.gerer'
        ];

        // 8. Permissions Commandes (CRUD séparé)
        $orderPermissions = [
            'commandes.voir',
            'commandes.creer',
            'commandes.modifier',
            'commandes.supprimer',
            'commandes.traiter',
            'commandes.rembourser',
            'commandes.exporter'
        ];

        // 9. Permissions Coupons (CRUD séparé)
        $couponPermissions = [
            'coupons.voir',
            'coupons.creer',
            'coupons.modifier',
            'coupons.supprimer'
        ];

        // 10. Permissions Livraison (CRUD séparé)
        $deliveryPermissions = [
            'livraisons.voir',
            'livraisons.assigner',
            'livraisons.suivre',
            'livraisons.modifier'
        ];

        // 11. Permissions Livreurs (CRUD séparé)
        $deliveryPersonPermissions = [
            'livreurs.voir',
            'livreurs.creer',
            'livreurs.modifier',
            'livreurs.supprimer'
        ];

        // 12. Permissions Transactions (CRUD séparé)
        $transactionPermissions = [
            'transactions.voir',
            'transactions.traiter',
            'transactions.rembourser'
        ];

        // 13. Permissions Méthodes de Paiement (CRUD séparé)
        $paymentMethodPermissions = [
            'methodes_paiement.voir',
            'methodes_paiement.creer',
            'methodes_paiement.modifier',
            'methodes_paiement.supprimer',
            'methodes_paiement.activer_desactiver'
        ];

        // 14. Permissions Factures (CRUD séparé)
        $invoicePermissions = [
            'factures.voir',
            'factures.generer',
            'factures.telecharger'
        ];

        // 15. Permissions Articles de Blog (CRUD séparé)
        $blogPostPermissions = [
            'articles_blog.voir',
            'articles_blog.creer',
            'articles_blog.modifier',
            'articles_blog.supprimer',
            'articles_blog.publier',
            'articles_blog.moderer'
        ];

        // 16. Permissions Commentaires (CRUD séparé)
        $blogCommentPermissions = [
            'commentaires.voir',
            'commentaires.approuver',
            'commentaires.rejeter',
            'commentaires.supprimer'
        ];

        // 17. Permissions Newsletter (CRUD séparé)
        $newsletterPermissions = [
            'newsletters.voir',
            'newsletters.creer',
            'newsletters.envoyer',
            'newsletters.supprimer'
        ];

        // 18. Permissions Bannières (CRUD séparé)
        $bannerPermissions = [
            'bannieres.voir',
            'bannieres.creer',
            'bannieres.modifier',
            'bannieres.supprimer'
        ];

        // 19. Permissions Clients (CRUD séparé)
        $clientPermissions = [
            'clients.voir',
            'clients.creer',
            'clients.modifier',
            'clients.supprimer',
            'clients.bloquer'
        ];

        // 20. Permissions Adresses (CRUD séparé)
        $addressPermissions = [
            'adresses.voir',
            'adresses.creer',
            'adresses.modifier',
            'adresses.supprimer'
        ];

        // 21. Permissions Avis (CRUD séparé)
        $reviewPermissions = [
            'avis.voir',
            'avis.approuver',
            'avis.rejeter',
            'avis.supprimer'
        ];

        // 22. Permissions Statistiques (CRUD séparé)
        $statsPermissions = [
            'statistiques.voir',
            'rapports.generer',
            'visiteurs.suivre'
        ];

        // 23. Permissions Paramètres (CRUD séparé)
        $settingsPermissions = [
            'parametres.voir',
            'parametres.modifier'
        ];

        // 27. Permissions Spéciales (Super Admin)
        $specialPermissions = [
            'audit.voir',
            'base_donnees.exporter'
        ];

        // Combine all permissions
        $allPermissions = array_merge(
            $userPermissions,
            $rolePermissions,
            $permissionPermissions,
            $productPermissions,
            $categoryPermissions,
            $subcategoryPermissions,
            $stockPermissions,
            $orderPermissions,
            $couponPermissions,
            $deliveryPermissions,
            $deliveryPersonPermissions,
            $transactionPermissions,
            $paymentMethodPermissions,
            $invoicePermissions,
            $blogPostPermissions,
            $blogCommentPermissions,
            $newsletterPermissions,
            $bannerPermissions,
            $clientPermissions,
            $addressPermissions,
            $reviewPermissions,
            $statsPermissions,
            $settingsPermissions,
            $specialPermissions
        );

        // Create permissions using loop with descriptions
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'description' => $this->getPermissionDescription($permission)
            ]);
        }
    }

    /**
     * Get the description for a permission
     */
    private function getPermissionDescription($permission): string
    {
        $descriptions = [
            // Utilisateurs
            'utilisateurs.voir' => 'Permet de voir la liste des utilisateurs du système',
            'utilisateurs.creer' => 'Permet de créer de nouveaux utilisateurs',
            'utilisateurs.modifier' => 'Permet de modifier les informations des utilisateurs',
            'utilisateurs.supprimer' => 'Permet de supprimer des utilisateurs du système',
            'utilisateurs.impersonifier' => 'Permet de se connecter en tant qu\'un autre utilisateur',

            // Rôles
            'roles.voir' => 'Permet de voir la liste des rôles disponibles',
            'roles.creer' => 'Permet de créer de nouveaux rôles',
            'roles.modifier' => 'Permet de modifier les rôles existants',
            'roles.supprimer' => 'Permet de supprimer des rôles',
            'roles.assigner' => 'Permet d\'assigner des rôles aux utilisateurs',

            // Permissions
            'permissions.voir' => 'Permet de voir la liste des permissions disponibles',
            'permissions.creer' => 'Permet de créer de nouvelles permissions',
            'permissions.modifier' => 'Permet de modifier les permissions existantes',
            'permissions.supprimer' => 'Permet de supprimer des permissions',
            'permissions.assigner' => 'Permet d\'assigner des permissions aux rôles',

            // Produits
            'produits.voir' => 'Permet de voir la liste des produits du catalogue',
            'produits.creer' => 'Permet d\'ajouter de nouveaux produits au catalogue',
            'produits.modifier' => 'Permet de modifier les informations des produits',
            'produits.supprimer' => 'Permet de supprimer des produits du catalogue',
            'produits.activer_desactiver' => 'Permet d\'activer ou désactiver des produits',

            // Catégories
            'categories.voir' => 'Permet de voir la liste des catégories de produits',
            'categories.creer' => 'Permet de créer de nouvelles catégories',
            'categories.modifier' => 'Permet de modifier les catégories existantes',
            'categories.supprimer' => 'Permet de supprimer des catégories',

            // Sous-catégories
            'sous_categories.voir' => 'Permet de voir la liste des sous-catégories',
            'sous_categories.creer' => 'Permet de créer de nouvelles sous-catégories',
            'sous_categories.modifier' => 'Permet de modifier les sous-catégories existantes',
            'sous_categories.supprimer' => 'Permet de supprimer des sous-catégories',

            // Stock
            'stock.voir' => 'Permet de voir les niveaux de stock des produits',
            'stock.modifier' => 'Permet de modifier les quantités en stock',
            'stock.gerer' => 'Permet de gérer complètement le stock (alertes, transferts, etc.)',

            // Commandes
            'commandes.voir' => 'Permet de voir la liste des commandes',
            'commandes.creer' => 'Permet de créer de nouvelles commandes manuellement',
            'commandes.modifier' => 'Permet de modifier les détails des commandes',
            'commandes.supprimer' => 'Permet de supprimer des commandes',
            'commandes.traiter' => 'Permet de traiter et valider les commandes',
            'commandes.rembourser' => 'Permet d\'effectuer des remboursements',
            'commandes.exporter' => 'Permet d\'exporter les données des commandes',

            // Coupons
            'coupons.voir' => 'Permet de voir la liste des coupons disponibles',
            'coupons.creer' => 'Permet de créer de nouveaux coupons de réduction',
            'coupons.modifier' => 'Permet de modifier les coupons existants',
            'coupons.supprimer' => 'Permet de supprimer des coupons',

            // Livraisons
            'livraisons.voir' => 'Permet de voir la liste des livraisons',
            'livraisons.assigner' => 'Permet d\'assigner des livreurs aux livraisons',
            'livraisons.suivre' => 'Permet de suivre l\'état des livraisons',
            'livraisons.modifier' => 'Permet de modifier les informations de livraison',

            // Livreurs
            'livreurs.voir' => 'Permet de voir la liste des livreurs',
            'livreurs.creer' => 'Permet d\'ajouter de nouveaux livreurs',
            'livreurs.modifier' => 'Permet de modifier les informations des livreurs',
            'livreurs.supprimer' => 'Permet de supprimer des livreurs',

            // Transactions
            'transactions.voir' => 'Permet de voir l\'historique des transactions',
            'transactions.traiter' => 'Permet de traiter les paiements',
            'transactions.rembourser' => 'Permet d\'effectuer des remboursements',

            // Méthodes de Paiement
            'methodes_paiement.voir' => 'Permet de voir les méthodes de paiement configurées',
            'methodes_paiement.creer' => 'Permet d\'ajouter de nouvelles méthodes de paiement',
            'methodes_paiement.modifier' => 'Permet de modifier les méthodes de paiement',
            'methodes_paiement.supprimer' => 'Permet de supprimer des méthodes de paiement',
            'methodes_paiement.activer_desactiver' => 'Permet d\'activer ou désactiver des méthodes de paiement',

            // Factures
            'factures.voir' => 'Permet de voir la liste des factures',
            'factures.generer' => 'Permet de générer de nouvelles factures',
            'factures.telecharger' => 'Permet de télécharger les factures',

            // Articles de Blog
            'articles_blog.voir' => 'Permet de voir la liste des articles de blog',
            'articles_blog.creer' => 'Permet de créer de nouveaux articles',
            'articles_blog.modifier' => 'Permet de modifier les articles existants',
            'articles_blog.supprimer' => 'Permet de supprimer des articles',
            'articles_blog.publier' => 'Permet de publier des articles',
            'articles_blog.moderer' => 'Permet de modérer le contenu des articles',

            // Commentaires
            'commentaires.voir' => 'Permet de voir la liste des commentaires',
            'commentaires.approuver' => 'Permet d\'approuver des commentaires',
            'commentaires.rejeter' => 'Permet de rejeter des commentaires',
            'commentaires.supprimer' => 'Permet de supprimer des commentaires',

            // Newsletters
            'newsletters.voir' => 'Permet de voir la liste des newsletters',
            'newsletters.creer' => 'Permet de créer de nouvelles newsletters',
            'newsletters.envoyer' => 'Permet d\'envoyer des newsletters',
            'newsletters.supprimer' => 'Permet de supprimer des newsletters',

            // Bannières
            'bannieres.voir' => 'Permet de voir la liste des bannières',
            'bannieres.creer' => 'Permet de créer de nouvelles bannières',
            'bannieres.modifier' => 'Permet de modifier les bannières existantes',
            'bannieres.supprimer' => 'Permet de supprimer des bannières',

            // Clients
            'clients.voir' => 'Permet de voir la liste des clients',
            'clients.creer' => 'Permet de créer de nouveaux comptes clients',
            'clients.modifier' => 'Permet de modifier les informations des clients',
            'clients.supprimer' => 'Permet de supprimer des comptes clients',
            'clients.bloquer' => 'Permet de bloquer des comptes clients',

            // Adresses
            'adresses.voir' => 'Permet de voir les adresses des clients',
            'adresses.creer' => 'Permet d\'ajouter de nouvelles adresses',
            'adresses.modifier' => 'Permet de modifier les adresses existantes',
            'adresses.supprimer' => 'Permet de supprimer des adresses',

            // Avis
            'avis.voir' => 'Permet de voir la liste des avis clients',
            'avis.approuver' => 'Permet d\'approuver des avis clients',
            'avis.rejeter' => 'Permet de rejeter des avis clients',
            'avis.supprimer' => 'Permet de supprimer des avis clients',

            // Statistiques
            'statistiques.voir' => 'Permet d\'accéder aux statistiques du site',
            'rapports.generer' => 'Permet de générer des rapports',
            'visiteurs.suivre' => 'Permet de suivre les visiteurs du site',

            // Paramètres
            'parametres.voir' => 'Permet de voir les paramètres du système',
            'parametres.modifier' => 'Permet de modifier les paramètres du système',

            // Permissions Spéciales
            'audit.voir' => 'Permet de voir les logs d\'audit du système',
            'base_donnees.exporter' => 'Permet d\'exporter la base de données complète',
        ];

        return $descriptions[$permission] ?? 'Permission pour ' . str_replace('_', ' ', $permission);
    }
}
