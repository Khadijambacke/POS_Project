<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - POS</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            background-color: #f0f2f5;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #1a1f2e;
            color: #fff;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar-brand {
            padding: 20px;
            background-color: #0d6efd;
            text-align: center;
        }

        .sidebar-brand h5 {
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 8px;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
            text-decoration: none;
        }

        .sidebar .section-title {
            font-size: 11px;
            text-transform: uppercase;
            color: #6c757d;
            padding: 15px 20px 5px;
            letter-spacing: 1px;
        }

        .sidebar .logout-link {
            color: #dc3545;
        }

        .sidebar .logout-link:hover {
            background-color: #dc3545;
            color: #fff;
        }

        /* Content */
        .content {
            flex-grow: 1;
            padding: 25px;
            overflow-y: auto;
        }

        

        
    </style>
</head>
<body>

    <!-- ===== SIDEBAR ===== -->
    <nav class="sidebar p-2">

        <div class="sidebar-brand mb-3">
            <i class="bi bi-shop fs-4"></i>
            <h5 class="mt-1">POS Admin</h5>
        </div>

        <ul class="nav flex-column px-2 flex-grow-1">

            <span class="section-title">Principal</span>

            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="bi bi-speedometer2"></i> Tableau de bord
                </a>
            </li>

            <span class="section-title">Gestion</span>

            <li class="nav-item">
                <a href="{{ route('vueproduit.index') }}" class="nav-link">
                    <i class="bi bi-box-seam"></i> Produits
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('toutcategrie') }}" class="nav-link">
                    <i class="bi bi-tags"></i> Catégories
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
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
            <a href="#" class="nav-link logout-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left"></i> Déconnexion
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

    </nav>

    @yield('contenu')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>