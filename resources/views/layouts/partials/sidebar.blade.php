<nav class="sidebar p-2">

    <div class="sidebar-brand mb-3">
        <i class="bi bi-shop fs-4"></i>
        <h5 class="mt-1">POS Admin</h5>
    </div>

    <ul class="nav flex-column px-2 flex-grow-1">

        <span class="section-title">Principal</span>

        <li class="nav-item">
            <a href="#" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Tableau de bord
            </a>
        </li>

        <span class="section-title">Gestion</span>

        <li class="nav-item">
            <a href="{{ route('toutcategrie') }}"
               class="nav-link {{ request()->routeIs('produits.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Produits
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('toutcategrie') }}"
               class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Catégories
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-archive"></i> Stock
            </a>
        </li>

        <span class="section-title">Ventes</span>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-receipt"></i> Historique ventes
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-bar-chart"></i> Rapports
            </a>
        </li>

        <span class="section-title">Utilisateurs</span>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-people"></i> Caissiers
            </a>
        </li>

    </ul>

    <!-- Déconnexion -->
    <div class="px-2 pb-3 mt-auto">
        <a href="#"
           class="nav-link logout-link"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-left"></i> Déconnexion
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

</nav>
