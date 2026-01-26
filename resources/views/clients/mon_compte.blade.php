<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte | ProLocAuto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <style>
        :root { --primary-color: #007BFF; }
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; }
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 15px 50px; background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .navbar .logo { font-size: 1.8em; font-weight: bold; color: var(--primary-color); text-decoration: none; }
        .navbar-links a { margin-left: 20px; text-decoration: none; color: #333; font-weight: 500; }
        .account-container { max-width: 1200px; margin: 50px auto; padding: 0 20px; }
        .dashboard-grid { display: grid; grid-template-columns: 1fr 3fr; gap: 30px; }
        .sidebar-menu { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .sidebar-menu a { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; text-decoration: none; color: #555; border-bottom: 1px solid #eee; }
        .main-content { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .info-card { background-color: #f1f8ff; padding: 20px; border-radius: 6px; margin-bottom: 20px; border-left: 5px solid var(--primary-color); }
        .reservation-item { background: white; padding: 15px; margin-bottom: 15px; border-radius: 8px; border: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .res-actions { display: flex; gap: 10px; margin-top: 10px; }
        @media (max-width: 900px) { .dashboard-grid { grid-template-columns: 1fr; } .navbar { flex-direction: column; } }
    </style>
</head>
<body>
   
    <nav class="navbar">
        <a href="{{ route('clients.accueil') }}" class="logo">ProLocAuto</a>
        <div class="navbar-links">
            <a href="{{ route('clients.accueil') }}">Accueil</a>
            <a href="{{ route('tarif') }}">Tarifs</a>
            <a href="{{ route('clients.mon-compte') }}">Mon Compte</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Déconnexion</button>
            </form>
        </div>
    </nav>

    <div class="account-container">
        <h1>Mon Compte</h1>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <div class="dashboard-grid">
            
            <div class="sidebar-menu">
                <a href="{{ route('clients.dashboard.tableaudebord') }}">Tableau de bord</a>
                <a href="{{ route('clients.mon-compte') }}">Mes Réservations</a>
                <a href="{{ route('clients.notifications') }}">
                    Notifications
                    @if(isset($unreadCount) && $unreadCount > 0)
                        <span class="badge bg-danger rounded-pill">{{ $unreadCount }}</span>
                    @endif
                </a>
            </div>

            <div class="main-content">
                <h2>Bienvenue, {{ $client->name ?? 'Client' }} !</h2>
                
                <div class="info-card">
                    <h2>Vos Réservations</h2>
                    
                    @forelse($reservations as $reservation)
                        
                        {{-- Calcul de la condition "Trop tard" (moins de 3 jours) --}}
                        @php
                            $isTooLate = \Carbon\Carbon::now()->addDays(3)->gt($reservation->date_debut);
                        @endphp

                        <div class="reservation-item">
                            <div>
                                <h5 class="mb-1 text-primary">{{ $reservation->annonce->titre ?? 'Espace (supprimé)' }}</h5>
                                <div class="text-muted small">
                                    Début : {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }} 
                                    • Durée : {{ $reservation->duree }}
                                </div>
                                <div class="mt-1">
                                    @if($reservation->statut == 'Annulée')
                                        <span class="badge bg-danger">🚫 Annulée</span>
                                    @elseif($reservation->statut == 'En attente de modification')
                                        <span class="badge bg-warning text-dark">⏳ Modification demandée</span>
                                    @elseif($reservation->statut == 'Modification refusée')
                                        <span class="badge bg-danger">❌ Modification refusée</span>
                                    @else
                                        <span class="badge bg-success">✅ Confirmée</span>
                                    @endif
                                </div>
                            </div>

                            @if($reservation->statut != 'Annulée')
                                <div class="res-actions">
                                    
                                    <!-- CAS 1 : C'EST TROP TARD (< 3 jours) -->
                                    @if($isTooLate)
                                        <span class="badge bg-secondary text-white p-2" title="Délai de préavis de 3 jours dépassé">
                                            <i class="fas fa-lock"></i> Verrouillé (J-3)
                                        </span>
                                    
                                    <!-- CAS 2 : STATUT EN ATTENTE -->
                                    @elseif($reservation->statut == 'En attente de modification')
                                        <small class="text-muted fst-italic align-self-center">Traitement en cours...</small>
                                    
                                    <!-- CAS 3 : ON PEUT MODIFIER/ANNULER -->
                                    @else
                                        <button type="button" class="btn btn-sm btn-outline-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal-{{ $reservation->id }}">
                                            Demander modif.
                                        </button>

                                        <form action="{{ route('reservation.annuler', $reservation->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Annuler</button>
                                        </form>
                                    @endif

                                </div>
                            @endif
                        </div>

                        <!-- MODAL (N'apparaît que si pas trop tard, mais on laisse le code ici) -->
                        <div class="modal fade" id="editModal-{{ $reservation->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title">Demander une modification</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="alert alert-info small">
                                                <i class="fas fa-info-circle"></i> Vous pouvez demander une modification jusqu'à 3 jours avant le début de la location.
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Votre demande :</label>
                                                <textarea name="message_modif" class="form-control" rows="4" placeholder="Bonjour, je souhaiterais..." required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Envoyer la demande</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @empty
                        <p class="text-muted">Aucune réservation trouvée.</p>
                        <a href="{{ route('tarif') }}" class="btn btn-primary btn-sm">Réserver un espace</a>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>