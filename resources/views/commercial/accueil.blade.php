<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Commercial | ProLocAuto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand">Espace Commercial</span>
        <div class="d-flex align-items-center">
            <span class="text-white me-3">Bienvenue</span>
            <form action="{{ route('commercial.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light">Déconnexion</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Demandes de réservation</h2>
        <span class="badge bg-secondary">{{ count($demandes) }} dossiers</span>
    </div>
    
    <!-- Messages de notification -->
    @if(session('success')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
    @endif
    @if(session('warning')) 
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
    @endif

    <div class="card shadow-sm mt-3 border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Date demande</th>
                            <th scope="col">Client</th>
                            <th scope="col">Offre / Espace</th>
                            <th scope="col">Détails (Début / Durée)</th>
                            <th scope="col">Message</th>
                            <th scope="col">Statut</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($demandes as $demande)
                        <tr>
                            <td class="text-muted small">
                                {{ $demande->created_at->format('d/m/Y') }}<br>
                                {{ $demande->created_at->format('H:i') }}
                            </td>
                            <td class="fw-bold">{{ $demande->nom_client }}</td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $demande->titre_annonce }}</span>
                            </td>
                            <td>
                                <div><small class="text-muted">Début :</small> <strong>{{ $demande->date_debut->format('d/m/Y') }}</strong></div>
                                <div><small class="text-muted">Durée :</small> {{ $demande->duree }}</div>
                            </td>
                            <td>
                                @if($demande->message)
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="popover" title="Message du client" data-bs-content="{{ $demande->message }}">
                                        Lire
                                    </button>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                @if($demande->statut == 'En attente')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @elseif($demande->statut == 'Validée')
                                    <span class="badge bg-success">Validée</span>
                                @else
                                    <span class="badge bg-danger">Refusée</span>
                                @endif
                            </td>
                            <td class="text-end">
                                @if($demande->statut == 'En attente')
                                    <!-- FORMULAIRE POUR VALIDER (C'est ça qui corrige ton erreur GET) -->
                                    <form action="{{ route('commercial.valider', $demande->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Valider et créer réservation">
                                            ✅ Valider
                                        </button>
                                    </form>

                                    <!-- FORMULAIRE POUR REFUSER -->
                                    <form action="{{ route('commercial.refuser', $demande->id) }}" method="POST" class="d-inline ms-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Refuser le dossier" onclick="return confirm('Êtes-vous sûr de vouloir refuser cette demande ?')">
                                            ❌
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small fst-italic">Dossier traité</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <div class="fs-4">📭</div>
                                <div>Aucune demande de réservation en attente.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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