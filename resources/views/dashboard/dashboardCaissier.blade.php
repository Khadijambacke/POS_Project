<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caisse - POS</title>

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
            width: 220px;
            background-color: #1a1f2e;
            color: #fff;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar-brand {
            padding: 20px;
            background-color: #198754;
            text-align: center;
        }

        .sidebar-brand h5 {
            margin: 0;
            font-weight: 700;
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
            background-color: #198754;
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
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .stat-card .icon { font-size: 2.2rem; opacity: 0.8; }
        .stat-card .label { font-size: 13px; opacity: 0.9; }
        .stat-card .value { font-size: 1.6rem; font-weight: 700; }

        .bg-ventes-jour  { background: linear-gradient(135deg, #198754, #146c43); }
        .bg-total-jour   { background: linear-gradient(135deg, #0d6efd, #0a58ca); }
        .bg-panier       { background: linear-gradient(135deg, #fd7e14, #e35d12); }

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

        /* Scanner */
        .scan-input {
            border-radius: 10px;
            border: 2px solid #198754;
            padding: 12px 20px;
            font-size: 16px;
        }

        .scan-input:focus {
            border-color: #198754;
            box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.15);
            outline: none;
        }

        /* Panier */
        .panier-table th {
            font-size: 12px;
            text-transform: uppercase;
            color: #6c757d;
        }

        .total-box {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px 20px;
        }

        .total-box .total-label { color: #6c757d; font-size: 14px; }
        .total-box .total-value { font-size: 1.4rem; font-weight: 700; color: #1a1f2e; }

        .btn-valider {
            background-color: #198754;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: background 0.2s;
        }

        .btn-valider:hover { background-color: #146c43; color: #fff; }

        .btn-vider {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-size: 14px;
            width: 100%;
        }

        .btn-vider:hover { background-color: #b02a37; color: #fff; }

        /* Table */
        .table th { border-top: none; }
    </style>
</head>
<body>

    <!-- ===== SIDEBAR ===== -->
    <nav class="sidebar p-2">

        <div class="sidebar-brand mb-3">
            <i class="bi bi-cash-register fs-4"></i>
            <h5 class="mt-1">Caisse POS</h5>
        </div>

        <ul class="nav flex-column px-2 flex-grow-1">

            <span class="section-title">Menu</span>

            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="bi bi-house"></i> Accueil
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-cart-plus"></i> Nouvelle vente
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-clock-history"></i> Mes ventes du jour
                </a>
            </li>

        </ul>

        <!-- Infos caissier + Déconnexion -->
        <div class="px-2 pb-3 mt-auto">
            <div class="text-center mb-3 p-2" style="background:#2d3748; border-radius:8px;">
                <i class="bi bi-person-circle fs-3 text-success"></i>
                <p class="mb-0 mt-1 small text-white">{{ Auth::user()->name }}</p>
                <span class="badge bg-success">Caissier</span>
            </div>
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
                <h5 class="mb-0 fw-bold">Bienvenue, {{ Auth::user()->name }} 👋</h5>
                <small class="text-muted">{{ now()->format('d/m/Y - H:i') }}</small>
            </div>
            <div>
                <span class="badge bg-success fs-6">
                    <i class="bi bi-circle-fill me-1" style="font-size:8px;"></i> En service
                </span>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="row g-4 mb-4">

            <div class="col-md-4">
                <div class="stat-card bg-ventes-jour">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="label mb-1">Mes ventes aujourd'hui</p>
                            <p class="value mb-0">0</p>
                        </div>
                        <i class="bi bi-receipt icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-total-jour">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="label mb-1">Total encaissé aujourd'hui</p>
                            <p class="value mb-0">0 F</p>
                        </div>
                        <i class="bi bi-cash-stack icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-panier">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="label mb-1">Articles dans le panier</p>
                            <p class="value mb-0">0</p>
                        </div>
                        <i class="bi bi-cart icon"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- Zone de vente -->
        <div class="row g-4">

            <!-- Scanner + Panier -->
            <div class="col-md-8">
                <div class="card section-card">
                    <div class="card-header">
                        <i class="bi bi-upc-scan me-2 text-success"></i>Scanner un produit
                    </div>
                    <div class="card-body">

                        <!-- Champ scan -->
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-success text-white border-0">
                                <i class="bi bi-upc-scan"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control scan-input"
                                id="scan-input"
                                placeholder="Scanner le code-barres ou taper le nom du produit..."
                                autofocus
                            />
                        </div>

                        <!-- Tableau panier -->
                        <table class="table table-hover panier-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th>Prix unitaire</th>
                                    <th>Quantité</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="panier-body">
                                {{-- Les produits scannés apparaîtront ici --}}
                                <tr id="panier-vide">
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-cart-x fs-3 d-block mb-2"></i>
                                        Le panier est vide. Scannez un produit.
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <!-- Résumé + Paiement -->
            <div class="col-md-4">
                <div class="card section-card">
                    <div class="card-header">
                        <i class="bi bi-calculator me-2 text-success"></i>Résumé de la vente
                    </div>
                    <div class="card-body">

                        <!-- Totaux -->
                        <div class="total-box mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="total-label">Sous-total</span>
                                <span class="fw-semibold">0 F</span>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between">
                                <span class="total-label fw-bold">TOTAL</span>
                                <span class="total-value">0 F</span>
                            </div>
                        </div>

                        <!-- Mode de paiement -->
                        <p class="fw-semibold mb-2">Mode de paiement</p>
                        <div class="d-flex gap-2 mb-3">
                            <button class="btn btn-outline-success flex-grow-1 active">
                                <i class="bi bi-cash me-1"></i> Espèces
                            </button>
                            <button class="btn btn-outline-primary flex-grow-1">
                                <i class="bi bi-credit-card me-1"></i> Carte
                            </button>
                        </div>

                        <!-- Montant reçu -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Montant reçu (F)</label>
                            <input type="number" class="form-control" placeholder="0" id="montant-recu">
                        </div>

                        <!-- Monnaie à rendre -->
                        <div class="total-box mb-4">
                            <div class="d-flex justify-content-between">
                                <span class="total-label">Monnaie à rendre</span>
                                <span class="fw-bold text-success" id="monnaie-rendue">0 F</span>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <button class="btn-valider mb-2">
                            <i class="bi bi-check-circle me-2"></i> Valider la vente
                        </button>
                        <button class="btn-vider">
                            <i class="bi bi-trash me-2"></i> Vider le panier
                        </button>

                    </div>
                </div>
            </div>

        </div>

        @yield('contenu')

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Calcul monnaie automatique
        document.getElementById('montant-recu').addEventListener('input', function() {
            const total = 0; // sera remplacé par le vrai total
            const recu = parseFloat(this.value) || 0;
            const monnaie = recu - total;
            document.getElementById('monnaie-rendue').textContent =
                monnaie >= 0 ? monnaie.toLocaleString('fr-FR') + ' F' : '0 F';
        });

        // Garder le focus sur le scanner
        document.addEventListener('click', function() {
            document.getElementById('scan-input').focus();
        });
    </script>

</body>
</html>