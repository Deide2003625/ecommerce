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
            'avis.supprimer',
            'avis.creer'
        ];

        $descriptions = [
            // Utilisateurs
            'utilisateurs.voir' => 'Voir la liste des utilisateurs',
            'utilisateurs.creer' => 'Créer un nouvel utilisateur',
            'utilisateurs.modifier' => 'Modifier un utilisateur',
            'utilisateurs.supprimer' => 'Supprimer un utilisateur',
            'utilisateurs.impersonifier' => 'Se connecter en tant qu’un autre utilisateur',

            // Rôles
            'roles.voir' => 'Voir la liste des rôles',
            'roles.creer' => 'Créer un nouveau rôle',
            'roles.modifier' => 'Modifier un rôle',
            'roles.supprimer' => 'Supprimer un rôle',
            'roles.assigner' => 'Assigner un rôle à un utilisateur',

            // Permissions
            'permissions.voir' => 'Voir la liste des permissions',
            'permissions.assigner' => 'Assigner une permission à un rôle',

            // Produits
            'produits.voir' => 'Voir la liste des produits',
            'produits.creer' => 'Créer un nouveau produit',
            'produits.modifier' => 'Modifier un produit',
            'produits.supprimer' => 'Supprimer un produit',
            'produits.activer_desactiver' => 'Activer ou désactiver un produit',

            // Catégories
            'categories.voir' => 'Voir la liste des catégories',
            'categories.creer' => 'Créer une nouvelle catégorie',
            'categories.modifier' => 'Modifier une catégorie',
            'categories.supprimer' => 'Supprimer une catégorie',

            // Sous-catégories
            'sous_categories.voir' => 'Voir la liste des sous-catégories',
            'sous_categories.creer' => 'Créer une nouvelle sous-catégorie',
            'sous_categories.modifier' => 'Modifier une sous-catégorie',
            'sous_categories.supprimer' => 'Supprimer une sous-catégorie',

            // Stock
            'stock.voir' => 'Voir le stock',
            'stock.modifier' => 'Modifier le stock',
            'stock.gerer' => 'Gérer le stock',

            // Commandes
            'commandes.voir' => 'Voir la liste des commandes',
            'commandes.creer' => 'Créer une nouvelle commande',
            'commandes.modifier' => 'Modifier une commande',
            'commandes.supprimer' => 'Supprimer une commande',
            'commandes.traiter' => 'Traiter une commande',
            'commandes.rembourser' => 'Rembourser une commande',
            'commandes.exporter' => 'Exporter les commandes',
            'commandes.annuler' => 'Annuler une commande',
            'commandes.payer' => 'Payer une commande',

            // Coupons
            'coupons.voir' => 'Voir la liste des coupons',
            'coupons.creer' => 'Créer un nouveau coupon',
            'coupons.modifier' => 'Modifier un coupon',
            'coupons.supprimer' => 'Supprimer un coupon',

            // Livraison
            'livraisons.voir' => 'Voir la liste des livraisons',
            'livraisons.assigner' => 'Assigner une livraison',
            'livraisons.suivre' => 'Suivre une livraison',
            'livraisons.modifier' => 'Modifier une livraison',

            // Livreurs
            'livreurs.voir' => 'Voir la liste des livreurs',
            'livreurs.creer' => 'Créer un livreur',
            'livreurs.modifier' => 'Modifier un livreur',
            'livreurs.supprimer' => 'Supprimer un livreur',

            // Transactions
            'transactions.voir' => 'Voir la liste des transactions',
            'transactions.traiter' => 'Traiter une transaction',
            'transactions.rembourser' => 'Rembourser une transaction',

            // Méthodes de paiement
            'methodes_paiement.voir' => 'Voir les méthodes de paiement',
            'methodes_paiement.creer' => 'Créer une méthode de paiement',
            'methodes_paiement.modifier' => 'Modifier une méthode de paiement',
            'methodes_paiement.supprimer' => 'Supprimer une méthode de paiement',
            'methodes_paiement.activer_desactiver' => 'Activer ou désactiver une méthode de paiement',

            // Factures
            'factures.voir' => 'Voir la liste des factures',
            'factures.generer' => 'Générer une facture',
            'factures.telecharger' => 'Télécharger une facture',

            // Articles de blog
            'articles_blog.voir' => 'Voir la liste des articles de blog',
            'articles_blog.creer' => 'Créer un article de blog',
            'articles_blog.modifier' => 'Modifier un article de blog',
            'articles_blog.supprimer' => 'Supprimer un article de blog',
            'articles_blog.publier' => 'Publier un article de blog',
            'articles_blog.moderer' => 'Modérer un article de blog',

            // Commentaires
            'commentaires.voir' => 'Voir la liste des commentaires',
            'commentaires.approuver' => 'Approuver un commentaire',
            'commentaires.rejeter' => 'Rejeter un commentaire',
            'commentaires.supprimer' => 'Supprimer un commentaire',

            // Newsletters
            'newsletters.voir' => 'Voir la liste des newsletters',
            'newsletters.creer' => 'Créer une newsletter',
            'newsletters.envoyer' => 'Envoyer une newsletter',
            'newsletters.supprimer' => 'Supprimer une newsletter',

            // Bannières
            'bannieres.voir' => 'Voir la liste des bannières',
            'bannieres.creer' => 'Créer une bannière',
            'bannieres.modifier' => 'Modifier une bannière',
            'bannieres.supprimer' => 'Supprimer une bannière',

            // Clients
            'clients.voir' => 'Voir la liste des clients',
            'clients.creer' => 'Créer un client',
            'clients.modifier' => 'Modifier un client',
            'clients.supprimer' => 'Supprimer un client',
            'clients.bloquer' => 'Bloquer un client',

            // Adresses
            'adresses.voir' => 'Voir la liste des adresses',
            'adresses.creer' => 'Créer une adresse',
            'adresses.modifier' => 'Modifier une adresse',
            'adresses.supprimer' => 'Supprimer une adresse',

            // Avis
            'avis.voir' => 'Voir la liste des avis',
            'avis.approuver' => 'Approuver un avis',
            'avis.rejeter' => 'Rejeter un avis',
            'avis.supprimer' => 'Supprimer un avis',
            'avis.creer' => 'Créer un avis',

            // Statistiques
            'statistiques.voir' => 'Voir les statistiques',
            'rapports.generer' => 'Générer un rapport',
            'visiteurs.suivre' => 'Suivre les visiteurs',

            // Paramètres
            'parametres.voir' => 'Voir les paramètres',
            'parametres.modifier' => 'Modifier les paramètres',

            // Permissions spéciales
            'audit.voir' => 'Voir les audits',
            'base_donnees.exporter' => 'Exporter la base de données',
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
            $desc = $this->getPermissionDescription($permission);
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'description' => $desc ?: ucfirst(str_replace('.', ' ', $permission))
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
            'utilisateurs.voir' => 'voir la liste des utilisateurs du système',
            'utilisateurs.creer' => 'créer de nouveaux utilisateurs',
            'utilisateurs.modifier' => 'modifier les informations des utilisateurs',
            'utilisateurs.supprimer' => 'supprimer des utilisateurs du système',
            'utilisateurs.impersonifier' => 'se connecter en tant qu\'un autre utilisateur',

            // Rôles
            'roles.voir' => 'voir la liste des rôles disponibles',
            'roles.creer' => 'créer de nouveaux rôles',
            'roles.modifier' => 'modifier les rôles existants',
            'roles.supprimer' => 'supprimer des rôles',
            'roles.assigner' => 'd\'assigner des rôles aux utilisateurs',

            // Permissions
            'permissions.voir' => 'voir la liste des permissions disponibles',

            // Produits
            'produits.voir' => 'voir la liste des produits du catalogue',
            'produits.creer' => 'd\'ajouter de nouveaux produits au catalogue',
            'produits.modifier' => 'modifier les informations des produits',
            'produits.supprimer' => 'supprimer des produits du catalogue',
            'produits.activer_desactiver' => 'd\'activer ou désactiver des produits',

            // Catégories
            'categories.voir' => 'voir la liste des catégories de produits',
            'categories.creer' => 'créer de nouvelles catégories',
            'categories.modifier' => 'modifier les catégories existantes',
            'categories.supprimer' => 'supprimer des catégories',

            // Sous-catégories
            'sous_categories.voir' => 'voir la liste des sous-catégories',
            'sous_categories.creer' => 'créer de nouvelles sous-catégories',
            'sous_categories.modifier' => 'modifier les sous-catégories existantes',
            'sous_categories.supprimer' => 'supprimer des sous-catégories',

            // Stock
            'stock.voir' => 'voir les niveaux de stock des produits',
            'stock.modifier' => 'modifier les quantités en stock',
            'stock.gerer' => 'gérer complètement le stock (alertes, transferts, etc.)',

            // Commandes
            'commandes.voir' => 'voir la liste des commandes',
            'commandes.creer' => 'créer de nouvelles commandes manuellement',
            'commandes.modifier' => 'modifier les détails des commandes',
            'commandes.supprimer' => 'supprimer des commandes',
            'commandes.traiter' => 'traiter et valider les commandes',
            'commandes.rembourser' => 'd\'effectuer des remboursements',
            'commandes.exporter' => 'd\'exporter les données des commandes',

            // Coupons
            'coupons.voir' => 'voir la liste des coupons disponibles',
            'coupons.creer' => 'créer de nouveaux coupons de réduction',
            'coupons.modifier' => 'modifier les coupons existants',
            'coupons.supprimer' => 'supprimer des coupons',

            // Livraisons
            'livraisons.voir' => 'voir la liste des livraisons',
            'livraisons.assigner' => 'd\'assigner des livreurs aux livraisons',
            'livraisons.suivre' => 'suivre l\'état des livraisons',
            'livraisons.modifier' => 'modifier les informations de livraison',

            // Livreurs
            'livreurs.voir' => 'voir la liste des livreurs',
            'livreurs.creer' => 'd\'ajouter de nouveaux livreurs',
            'livreurs.modifier' => 'modifier les informations des livreurs',
            'livreurs.supprimer' => 'supprimer des livreurs',

            // Transactions
            'transactions.voir' => 'voir l\'historique des transactions',
            'transactions.traiter' => 'traiter les paiements',
            'transactions.rembourser' => 'd\'effectuer des remboursements',

            // Méthodes de Paiement
            'methodes_paiement.voir' => 'voir les méthodes de paiement configurées',
            'methodes_paiement.creer' => 'd\'ajouter de nouvelles méthodes de paiement',
            'methodes_paiement.modifier' => 'modifier les méthodes de paiement',
            'methodes_paiement.supprimer' => 'supprimer des méthodes de paiement',
            'methodes_paiement.activer_desactiver' => 'd\'activer ou désactiver des méthodes de paiement',

            // Factures
            'factures.voir' => 'voir la liste des factures',
            'factures.generer' => 'générer de nouvelles factures',
            'factures.telecharger' => 'télécharger les factures',

            // Articles de Blog
            'articles_blog.voir' => 'voir la liste des articles de blog',
            'articles_blog.creer' => 'créer de nouveaux articles',
            'articles_blog.modifier' => 'modifier les articles existants',
            'articles_blog.supprimer' => 'supprimer des articles',
            'articles_blog.publier' => 'publier des articles',
            'articles_blog.moderer' => 'modérer le contenu des articles',

            // Commentaires
            'commentaires.voir' => 'voir la liste des commentaires',
            'commentaires.approuver' => 'd\'approuver des commentaires',
            'commentaires.rejeter' => 'rejeter des commentaires',
            'commentaires.supprimer' => 'supprimer des commentaires',

            // Newsletters
            'newsletters.voir' => 'voir la liste des newsletters',
            'newsletters.creer' => 'créer de nouvelles newsletters',
            'newsletters.envoyer' => 'd\'envoyer des newsletters',
            'newsletters.supprimer' => 'supprimer des newsletters',

            // Bannières
            'bannieres.voir' => 'voir la liste des bannières',
            'bannieres.creer' => 'créer de nouvelles bannières',
            'bannieres.modifier' => 'modifier les bannières existantes',
            'bannieres.supprimer' => 'supprimer des bannières',

            // Clients
            'clients.voir' => 'voir la liste des clients',
            'clients.creer' => 'créer de nouveaux comptes clients',
            'clients.modifier' => 'modifier les informations des clients',
            'clients.supprimer' => 'supprimer des comptes clients',
            'clients.bloquer' => 'bloquer des comptes clients',

            // Adresses
            'adresses.voir' => 'voir les adresses des clients',
            'adresses.creer' => 'd\'ajouter de nouvelles adresses',
            'adresses.modifier' => 'modifier les adresses existantes',
            'adresses.supprimer' => 'supprimer des adresses',

            // Avis
            'avis.voir' => 'voir la liste des avis clients',
            'avis.approuver' => 'd\'approuver des avis clients',
            'avis.rejeter' => 'rejeter des avis clients',
            'avis.supprimer' => 'supprimer des avis clients',

            // Statistiques
            'statistiques.voir' => 'd\'accéder aux statistiques du site',
            'rapports.generer' => 'générer des rapports',
            'visiteurs.suivre' => 'suivre les visiteurs du site',

            // Paramètres
            'parametres.voir' => 'voir les paramètres du système',
            'parametres.modifier' => 'modifier les paramètres du système',

            // Permissions Spéciales
            'audit.voir' => 'voir les logs d\'audit du système',
            'base_donnees.exporter' => 'd\'exporter la base de données complète',
        ];

        return $descriptions[$permission] ?? 'Permission pour ' . str_replace('_', ' ', $permission);
    }
}
