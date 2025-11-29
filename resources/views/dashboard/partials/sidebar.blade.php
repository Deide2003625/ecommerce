<aside class="sidebar">
  <button type="button" class="sidebar-close-btn">
    <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
  </button>

  <div>
    <a href="dashboard.html" class="sidebar-logo">
      <img src="images/logo.png" alt="site logo" class="light-logo">
      <img src="images/logo-light.png" alt="site logo" class="dark-logo">
      <img src="images/logo-icon.png" alt="site logo" class="logo-icon">
    </a>
  </div>

  <div class="sidebar-menu-area">
    <ul class="sidebar-menu" id="sidebar-menu">

      <!-- Tableau de bord -->
      <li>
        <a href="dashboard.html">
          <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
          <span>Tableau de bord</span>
        </a>
      </li>

      <!-- Catalogue -->
      <li class="sidebar-menu-group-title">Catalogue</li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <iconify-icon icon="carbon:categories" class="menu-icon"></iconify-icon>
          <span>Catégories</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="categories-create.html">
              <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Ajouter une catégorie
            </a>
          </li>
          <li>
            <a href="categories-list.html">
              <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Liste des catégories
            </a>
          </li>
        </ul>
      </li>

      <li class="dropdown">
        <a href="javascript:void(0)">
          <iconify-icon icon="tabler:shopping-cart" class="menu-icon"></iconify-icon>
          <span>Produits</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="products-create.html">
              <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Ajouter un produit
            </a>
          </li>
          <li>
            <a href="products-list.html">
              <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Liste des produits
            </a>
          </li>
        </ul>
      </li>

      <!-- Commandes & Clients -->
      <li class="sidebar-menu-group-title">Commandes & Clients</li>
      <li>
        <a href="{{ route('commandes.index') }}">
          <iconify-icon icon="ic:outline-shopping-bag" class="menu-icon"></iconify-icon>
          <span>Commandes</span>
        </a>
      </li>
      <li>
        <a href="{{ route('clients.index') }}">
          <iconify-icon icon="mdi:account-group" class="menu-icon"></iconify-icon>
          <span>Clients</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0)">
          <iconify-icon icon="mdi:star-outline" class="menu-icon"></iconify-icon>
          <span>Avis clients</span>
        </a>
      </li>

      <!-- Promotions -->
      <li class="sidebar-menu-group-title">Promotions</li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <iconify-icon icon="ph:ticket-bold" class="menu-icon"></iconify-icon>
          <span>Coupons</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="coupons-create.html">
              <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Ajouter un coupon
            </a>
          </li>
          <li>
            <a href="coupons-list.html">
              <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Liste des coupons
            </a>
          </li>
        </ul>
      </li>

      <!-- Livraison -->
      <li class="sidebar-menu-group-title">Livraison</li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <iconify-icon icon="mdi:truck-delivery-outline" class="menu-icon"></iconify-icon>
          <span>Livreurs</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="delivery-persons-create.html">
              <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Ajouter un livreur
            </a>
          </li>
          <li>
            <a href="delivery-persons-list.html">
              <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Liste des livreurs
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="javascript:void(0)">
          <iconify-icon icon="mdi:package-variant-closed" class="menu-icon"></iconify-icon>
          <span>Livraisons</span>
        </a>
      </li>

      <!-- Marketing -->
      <li class="sidebar-menu-group-title">Marketing</li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <iconify-icon icon="mdi:image-area" class="menu-icon"></iconify-icon>
          <span>Bannières</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="banners-create.html">
              <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Ajouter une bannière
            </a>
          </li>
          <li>
            <a href="banners-list.html">
              <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Liste des bannières
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="javascript:void(0)">
          <iconify-icon icon="mdi:email-newsletter" class="menu-icon"></iconify-icon>
          <span>Newsletter</span>
        </a>
      </li>

      <!-- Blog -->
      <li class="sidebar-menu-group-title">Blog</li>
      <li>
        <a href="javascript:void(0)">
          <iconify-icon icon="mdi:bookmark-outline" class="menu-icon"></iconify-icon>
          <span>Catégories</span>
        </a>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <iconify-icon icon="mdi:post-outline" class="menu-icon"></iconify-icon>
          <span>Articles</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="blog-posts-create.html">
              <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Ajouter un article
            </a>
          </li>
          <li>
            <a href="blog-posts-list.html">
              <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Liste des articles
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="javascript:void(0)">
          <iconify-icon icon="mdi:comment-text-outline" class="menu-icon"></iconify-icon>
          <span>Commentaires</span>
        </a>
      </li>

      <!-- Statistiques -->
      <li class="sidebar-menu-group-title">Statistiques</li>
      <li>
        <a href="javascript:void(0)">
          <iconify-icon icon="mdi:finance" class="menu-icon"></iconify-icon>
          <span>Rapport des ventes</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0)">
          <iconify-icon icon="mdi:chart-box-outline" class="menu-icon"></iconify-icon>
          <span>Statistiques visiteurs</span>
        </a>
      </li>

      <!-- Paramètres -->
      <li class="sidebar-menu-group-title">Paramètres</li>
      <li>
        <a href="javascript:void(0)">
          <iconify-icon icon="mdi:cog-outline" class="menu-icon"></iconify-icon>
          <span>Paramètres généraux</span>
        </a>

      </li>
      <li>
        <a href="javascript:void(0)">
          <iconify-icon icon="mdi:credit-card-outline" class="menu-icon"></iconify-icon>
          <span>Méthodes de paiement</span>
        </a>
      </li>

      <!-- Administration -->
      <li class="sidebar-menu-group-title">Administration</li>
      <li>
        <a href="{{ route('users.index') }}">
          <iconify-icon icon="mdi:account-multiple-outline" class="menu-icon"></iconify-icon>
          <span>Utilisateurs</span>
        </a>
      </li>
      <li>
        <a href="{{ route('roles.index') }}">
          <iconify-icon icon="mdi:shield-account-outline" class="menu-icon"></iconify-icon>
          <span>Rôles</span>
        </a>
      </li>
    </ul>
  </div>
</aside>
