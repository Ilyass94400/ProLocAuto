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
        :root { --sidebar-width: 260px; --primary-color: #4e73df; --bg-light: #f8f9fc; }
        body { background-color: var(--bg-light); font-family: 'Nunito', sans-serif; overflow-x: hidden; }
        
        /* Sidebar */
        .sidebar { width: var(--sidebar-width); height: 100vh; background: linear-gradient(180deg, #4e73df 10%, #224abe 100%); color: white; position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar-brand { display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: 800; margin-bottom: 30px; text-decoration: none; color: white; }
        .nav-link { display: block; color: rgba(255,255,255,.8); padding: 15px 25px; text-decoration: none; font-weight: 600; }
        .nav-link:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-link.active { background: rgba(255,255,255,0.15); border-left: 4px solid white; color: white; }
        
        /* Main Content */
        .main-content { margin-left: var(--sidebar-width); display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { height: 70px; background-color: white; box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15); display: flex; align-items: center; justify-content: flex-end; padding: 0 30px; }
        .page-content { padding: 30px; }
        
        /* Cards */
        .card-custom { border: none; border-radius: 10px; box-shadow: 0 0.15rem 1.75rem 0 rgba(58,59,69,.15); background: white; overflow: hidden; margin-top: 30px; }
        .card-header-custom { background-color: white; padding: 20px 25px; border-bottom: 1px solid #e3e6f0; display: flex; justify-content: space-between; align-items: center; }
        
        /* Stats Cards */
        .stats-card { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 0.15rem 1.75rem 0 rgba(58,59,69,.15); border-left: 5px solid var(--primary-color); display: flex; justify-content: space-between; align-items: center; }
        .stats-card.warning { border-left-color: #f6c23e; }
        .stats-card.success { border-left-color: #1cc88a; }
        .stats-title { font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 5px; }
        .stats-value { font-size: 1.5rem; font-weight: 700; color: #5a5c69; }
        
        .btn-logout { background: none; border: none; color: #e74a3b; }
        
        @media (max-width: 768px) { .sidebar { width: 70px; } .sidebar span { display: none; } .main-content { margin-left: 70px; } }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <nav class="sidebar">
        <a href="{{ route('commercial.dashboard') }}" class="sidebar-brand"><i class="fas fa-building me-2"></i> <span>ProLocAuto</span></a>
        <ul class="p-0">
            <li class="nav-item"><a class="nav-link active" href="{{ route('commercial.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> <span>Dashboard</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('commercial.messagerie') }}"><i class="fas fa-envelope me-2"></i> <span>Messagerie</span></a></li>
        </ul>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <header class="topbar">
            <div class="d-flex align-items-center">
                <span class="d-none d-lg-inline small me-2 fw-bold text-secondary">{{ Auth::guard('commercial')->user()->name ?? 'Commercial' }}</span>
                <form action="{{ route('commercial.logout') }}" method="POST">
                    @csrf <button class="btn-logout" type="submit" title="Déconnexion"><i class="fas fa-sign-out-alt"></i></button>
                </form>
            </div>
        </header>

        <div class="page-content">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Vue d'ensemble</h1>
                <div>
                    <a href="{{ route('commercial.message.rediger') }}" class="btn btn-success btn-sm shadow-sm me-2"><i class="fas fa-pen me-1"></i> Nouveau message</a>
                    <a href="{{ route('commercial.messagerie') }}" class="btn btn-primary btn-sm shadow-sm"><i class="fas fa-envelope me-1"></i> Messagerie</a>
                </div>
            </div>

            <!-- MESSAGES FLASH -->
            @if(session('success')) <div class="alert alert-success alert-dismissible fade show">{{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div> @endif
            @if(session('warning')) <div class="alert alert-warning alert-dismissible fade show">{{ session('warning') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div> @endif

            <!-- STATS -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stats-card warning">
                        <div><div class="stats-title text-warning">En attente</div><div class="stats-value">{{ $demandes->where('statut', 'En attente')->count() }}</div></div>
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card success">
                        <div><div class="stats-title text-success">Validées</div><div class="stats-value">{{ $demandes->where('statut', 'Validée')->count() }}</div></div>
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div><div class="stats-title text-primary">Total Dossiers</div><div class="stats-value">{{ count($demandes) }}</div></div>
                        <i class="fas fa-folder-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>

            <!-- TABLEAU 1 : DEMANDES (Flux entrant) -->
            <div class="card-custom mb-5">
                <div class="card-header-custom">
                    <h6 class="m-0 font-weight-bold text-primary">📥 Demandes entrantes (À traiter)</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Offre</th>
                                    <th>Détails</th>
                                    <th>Statut</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($demandes as $demande)
                                <tr>
                                    <td>{{ $demande->created_at->format('d/m/Y') }}</td>
                                    <td class="fw-bold">{{ $demande->nom_client }}</td>
                                    <td><span class="badge bg-secondary">{{ $demande->titre_annonce }}</span></td>
                                    <td class="small">{{ $demande->duree }} dès le {{ $demande->date_debut->format('d/m/Y') }}</td>
                                    <td>
                                        @if($demande->statut == 'En attente') <span class="badge bg-warning text-dark">En attente</span>
                                        @elseif($demande->statut == 'Validée') <span class="badge bg-success">Traitée</span>
                                        @else <span class="badge bg-danger">Refusée</span> @endif
                                    </td>
                                    <td class="text-end">
                                        @if($demande->statut == 'En attente')
                                            <form action="{{ route('commercial.valider', $demande->id) }}" method="POST" class="d-inline">
                                                @csrf <button class="btn btn-success btn-sm" title="Valider">Valider</button>
                                            </form>
                                            <form action="{{ route('commercial.refuser', $demande->id) }}" method="POST" class="d-inline">
                                                @csrf <button class="btn btn-outline-danger btn-sm" title="Refuser">Refuser</button>
                                            </form>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center py-4 text-muted">Aucune demande.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TABLEAU 2 : RÉSERVATIONS ACTIVES (Où on peut modifier) -->
            <div class="card-custom border-left-success">
                <div class="card-header-custom">
                    <h6 class="m-0 font-weight-bold text-success">✅ Gestion des Réservations (Officielles)</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Client</th>
                                    <th>Espace Loué</th>
                                    <th>Période</th>
                                    <th>Prix</th>
                                    <th>État</th>
                                    <th class="text-end">Modifier</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservations as $res)
                                <tr>
                                    <td>#{{ $res->id }}</td>
                                    <td class="fw-bold">{{ $res->user->name ?? 'Inconnu' }}</td>
                                    <td>{{ $res->annonce->titre ?? 'Annonce supprimée' }}</td>
                                    <td>
                                        <div>Du {{ $res->date_debut->format('d/m/Y') }}</div>
                                        <div class="text-muted small">({{ $res->duree }})</div>
                                    </td>
                                    <td class="fw-bold">{{ $res->prix }} €</td>
                                    <td>
                                        @if($res->statut == 'Confirmée') <span class="badge bg-success">Actif</span>
                                        @elseif($res->statut == 'Payée') <span class="badge bg-primary">Payé</span>
                                        @elseif($res->statut == 'Annulée') <span class="badge bg-danger">Annulé</span>
                                        @else <span class="badge bg-secondary">{{ $res->statut }}</span> @endif
                                    </td>
                                    <td class="text-end">
                                        <!-- LE BOUTON MODIFIER EST ICI -->
                                        <a href="{{ route('commercial.reservations.edit', $res->id) }}" class="btn btn-sm btn-outline-primary shadow-sm">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="7" class="text-center py-4 text-muted">Aucune réservation validée pour l'instant.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
          return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>
</html>