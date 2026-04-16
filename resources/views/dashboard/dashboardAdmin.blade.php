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

        /* Header */
        .top-header {
            background-color: #fff;
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        /* Stat Cards */
        .stat-card {
            border: none;
            border-radius: 12px;
            padding: 20px;
            color: #fff;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .stat-card .icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }

        .stat-card .label {
            font-size: 13px;
            opacity: 0.9;
        }

        .stat-card .value {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .bg-ventes    { background: linear-gradient(135deg, #0d6efd, #0a58ca); }
        .bg-produits  { background: linear-gradient(135deg, #198754, #146c43); }
        .bg-caissiers { background: linear-gradient(135deg, #fd7e14, #e35d12); }
        .bg-stock     { background: linear-gradient(135deg, #dc3545, #b02a37); }

        /* Section Cards */
        .section-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .section-card .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f0f0f0;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
            padding: 15px 20px;
        }

        /* Table */
        .table th {
            font-size: 13px;
            text-transform: uppercase;
            color: #6c757d;
            border-top: none;
        }

        /* Badge stock */
        .badge-stock-ok      { background-color: #d1e7dd; color: #0a3622; }
        .badge-stock-faible  { background-color: #fff3cd; color: #664d03; }
        .badge-stock-rupture { background-color: #f8d7da; color: #58151c; }
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
                <a href="{{ route ('personnels.index')}}" class="nav-link">
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

    <!-- ===== CONTENT ===== -->
    <div class="content">

        <!-- Header -->
        <div class="top-header">
            <div>
                <h5 class="mb-0 fw-bold">Tableau de bord</h5>
                <small class="text-muted">{{ now()->format('d/m/Y') }}</small>
            </div>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-person-circle fs-4 text-primary"></i>
                <span class="fw-semibold">{{ Auth::user()->name }}</span>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="row g-4 mb-4">

            <div class="col-md-3">
                <div class="stat-card bg-ventes">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="label mb-1">Ventes aujourd'hui</p>
                            <p class="value mb-0">0</p>
                        </div>
                        <i class="bi bi-cart-check icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card bg-produits">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="label mb-1">Total produits</p>
                            <p class="value mb-0">0</p>
                        </div>
                        <i class="bi bi-box-seam icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card bg-caissiers">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="label mb-1">Caissiers actifs</p>
                            <p class="value mb-0">0</p>
                        </div>
                        <i class="bi bi-people icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card bg-stock">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="label mb-1">Alertes stock</p>
                            <p class="value mb-0">0</p>
                        </div>
                        <i class="bi bi-exclamation-triangle icon"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- Dernières ventes + Stock faible -->
        <div class="row g-4">

            <!-- Dernières ventes -->
            <div class="col-md-7">
                <div class="card section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-receipt me-2 text-primary"></i>Dernières ventes</span>
                        <a href="#" class="btn btn-sm btn-outline-primary">Voir tout</a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">N° Vente</th>
                                    <th>Caissier</th>
                                    <th>Total</th>
                                    <th>Paiement</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach($ventes as $vente)
                                <tr>
                                    <td class="ps-3">{{ $vente->id }}</td>
                                    <td>{{ $vente->caissier->name }}</td>
                                    <td>{{ number_format($vente->total, 0, ',', ' ') }} F</td>
                                    <td>{{ $vente->modepaiement }}</td>
                                    <td>{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @endforeach --}}
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Aucune vente pour le moment
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Alertes stock faible -->
            <div class="col-md-5">
                <div class="card section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-exclamation-triangle me-2 text-danger"></i>Stock faible</span>
                        <a href="#" class="btn btn-sm btn-outline-danger">Gérer</a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Produit</th>
                                    <th>Stock</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach($stockFaible as $produit)
                                <tr>
                                    <td class="ps-3">{{ $produit->nom }}</td>
                                    <td>{{ $produit->qtestock }}</td>
                                    <td>
                                        <span class="badge badge-stock-faible">Faible</span>
                                    </td>
                                </tr>
                                @endforeach --}}
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        Aucune alerte stock
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- Yield pour les pages enfants -->
        @yield('contenu')

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>