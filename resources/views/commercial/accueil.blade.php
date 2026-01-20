<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Commercial | ProLocAuto</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --bg-light: #f8f9fc;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Nunito', sans-serif;
            overflow-x: hidden;
        }

        /* --- SIDEBAR (Même style que messagerie) --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            z-index: 1000;
        }
        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 30px;
            text-decoration: none;
            color: white;
        }
        .sidebar-brand i { margin-right: 10px; font-size: 1.5rem; }
        .nav-item { list-style: none; }
        .nav-link {
            display: block;
            color: rgba(255,255,255,.8);
            padding: 15px 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }
        .nav-link:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.15);
            border-left-color: white;
        }
        .nav-link i { margin-right: 10px; width: 20px; text-align: center; }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- TOPBAR --- */
        .topbar {
            height: 70px;
            background-color: white;
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px;
        }
        .user-profile {
            display: flex;
            align-items: center;
            color: #555;
            font-weight: 600;
        }
        .user-avatar {
            width: 40px; height: 40px;
            background-color: #eaecf4;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #4e73df; margin-left: 10px;
        }
        .btn-logout { background: none; border: none; color: var(--danger-color); }

        /* --- DASHBOARD CARDS --- */
        .page-content { padding: 30px; }
        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58,59,69,.15);
            border-left: 5px solid var(--primary-color);
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .stats-card.warning { border-left-color: var(--warning-color); }
        .stats-card.success { border-left-color: var(--success-color); }
        .stats-title { font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 5px; }
        .stats-value { font-size: 1.5rem; font-weight: 700; color: #5a5c69; }
        .stats-icon { font-size: 2rem; color: #dddfeb; }

        /* --- TABLE STYLE --- */
        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58,59,69,.15);
            background: white;
            overflow: hidden;
            margin-top: 30px;
        }
        .card-header-custom {
            background-color: white;
            padding: 20px 25px;
            border-bottom: 1px solid #e3e6f0;
            display: flex; justify-content: space-between; align-items: center;
        }
        .table thead th {
            border-top: none;
            border-bottom: 1px solid #e3e6f0;
            font-size: 0.85rem;
            text-transform: uppercase;
            color: var(--secondary-color);
            font-weight: 700;
            padding: 15px;
        }
        .table tbody td { padding: 15px; vertical-align: middle; color: #5a5c69; font-size: 0.95rem; }
        .badge-status { padding: 5px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
        .badge-pending { background-color: #f6c23e20; color: #f6c23e; border: 1px solid #f6c23e; }
        .badge-success { background-color: #1cc88a20; color: #1cc88a; border: 1px solid #1cc88a; }
        .badge-danger { background-color: #e74a3b20; color: #e74a3b; border: 1px solid #e74a3b; }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { width: 70px; padding-top: 10px; }
            .sidebar .sidebar-brand span, .sidebar .nav-link span { display: none; }
            .sidebar .sidebar-brand i { font-size: 1.5rem; margin: 0; }
            .sidebar .nav-link { padding: 15px 0; text-align: center; }
            .main-content { margin-left: 70px; }
        }
    </style>
</head>
<body>

    <!-- 1. SIDEBAR -->
    <nav class="sidebar">
        <a href="{{ route('commercial.dashboard') }}" class="sidebar-brand">
            <i class="fas fa-building"></i>
            <span>ProLocAuto</span>
        </a>
        <ul class="p-0">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('commercial.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('commercial.messagerie') }}">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Messagerie</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- 2. MAIN CONTENT -->
    <div class="main-content">
        
        <!-- Topbar -->
        <header class="topbar">
            <div class="user-profile">
                <span class="d-none d-lg-inline small me-2">{{ Auth::guard('commercial')->user()->name ?? 'Commercial' }}</span>
                <div class="user-avatar"><i class="fas fa-user"></i></div>
                <div style="width: 1px; height: 30px; background: #e3e6f0; margin: 0 15px;"></div>
                <form action="{{ route('commercial.logout') }}" method="POST">
                    @csrf
                    <button class="btn-logout" type="submit" title="Déconnexion"><i class="fas fa-sign-out-alt"></i></button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <div class="page-content">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Vue d'ensemble</h1>
                <!-- Boutons d'action -->
                <div>
                    <a href="{{ route('commercial.message.rediger') }}" class="btn btn-success btn-sm shadow-sm me-2">
                        <i class="fas fa-pen fa-sm text-white-50 me-2"></i>Nouveau message
                    </a>
                    <a href="{{ route('commercial.messagerie') }}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fas fa-envelope fa-sm text-white-50 me-2"></i>Messagerie
                    </a>
                </div>
            </div>

            <!-- STATISTIQUES (Cartes) -->
            <div class="row">
                <!-- En Attente -->
                <div class="col-md-4 mb-4">
                    <div class="stats-card warning">
                        <div>
                            <div class="stats-title text-warning">En attente</div>
                            <div class="stats-value">{{ $demandes->where('statut', 'En attente')->count() }}</div>
                        </div>
                        <div class="stats-icon"><i class="fas fa-clock"></i></div>
                    </div>
                </div>
                <!-- Validées -->
                <div class="col-md-4 mb-4">
                    <div class="stats-card success">
                        <div>
                            <div class="stats-title text-success">Validées</div>
                            <div class="stats-value">{{ $demandes->where('statut', 'Validée')->count() }}</div>
                        </div>
                        <div class="stats-icon"><i class="fas fa-check-circle"></i></div>
                    </div>
                </div>
                <!-- Total -->
                <div class="col-md-4 mb-4">
                    <div class="stats-card">
                        <div>
                            <div class="stats-title text-primary">Total Dossiers</div>
                            <div class="stats-value">{{ count($demandes) }}</div>
                        </div>
                        <div class="stats-icon"><i class="fas fa-folder-open"></i></div>
                    </div>
                </div>
            </div>

            <!-- TABLEAU DES DEMANDES -->
            @if(session('success')) 
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div> 
            @endif
            @if(session('warning')) 
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div> 
            @endif

            <div class="card-custom">
                <div class="card-header-custom">
                    <h6 class="m-0 font-weight-bold text-primary">Dernières demandes de réservation</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Espace</th>
                                    <th>Détails</th>
                                    <th>Message</th>
                                    <th>Statut</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($demandes as $demande)
                                <tr>
                                    <td class="small">
                                        <div class="fw-bold">{{ $demande->created_at->format('d/m/Y') }}</div>
                                        <div class="text-muted">{{ $demande->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="fw-bold text-dark">{{ $demande->nom_client }}</td>
                                    <td><span class="badge bg-light text-dark border">{{ $demande->titre_annonce }}</span></td>
                                    <td class="small">
                                        <div><i class="fas fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</div>
                                        <div><i class="fas fa-hourglass-half me-1"></i> {{ $demande->duree }}</div>
                                    </td>
                                    <td>
                                        @if($demande->message)
                                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle" data-bs-toggle="popover" title="Note du client" data-bs-content="{{ $demande->message }}">
                                                <i class="fas fa-comment-dots"></i>
                                            </button>
                                        @else
                                            <span class="text-muted opacity-25">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($demande->statut == 'En attente')
                                            <span class="badge-status badge-pending">En attente</span>
                                        @elseif($demande->statut == 'Validée')
                                            <span class="badge-status badge-success">Validée</span>
                                        @else
                                            <span class="badge-status badge-danger">Refusée</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if($demande->statut == 'En attente')
                                            <form action="{{ route('commercial.valider', $demande->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm rounded-circle" title="Valider">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('commercial.refuser', $demande->id) }}" method="POST" class="d-inline ms-1">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm rounded-circle" title="Refuser" onclick="return confirm('Êtes-vous sûr ?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted small"><i class="fas fa-lock"></i> Verrouillé</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-gray-300 mb-3" style="font-size: 3rem; color: #ddd;"><i class="fas fa-folder-open"></i></div>
                                        <h5 class="text-muted">Aucune demande</h5>
                                        <p class="text-muted small">Tout est à jour pour le moment.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Active les bulles d'info (Popovers) pour les messages
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
          return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>
</html>