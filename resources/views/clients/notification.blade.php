<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Style pour les messages LUS */
        .list-group-item.read {
            background-color: #f8f9fa; /* Fond gris */
            opacity: 0.7; /* Légèrement transparent */
            border-left: 4px solid #ccc;
        }
        /* Style pour les messages NON LUS */
        .list-group-item.unread {
            background-color: #fff;
            border-left: 4px solid #007BFF; /* Barre bleue */
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container mt-5">
        
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('clients.mon-compte') }}" class="btn btn-outline-secondary me-3">Retour</a>
            <h1 class="mb-0">Mes Notifications</h1>
        </div>

        @if(session('success')) 
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div> 
        @endif

        <div class="list-group shadow-sm">
            @forelse($notifications as $notif)
                <!-- On applique la classe CSS en fonction de l'état 'lu' -->
                <div class="list-group-item p-4 {{ $notif->lu ? 'read' : 'unread' }}">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h5 class="mb-1 {{ $notif->lu ? 'text-muted' : 'text-primary' }}">{{ $notif->sujet }}</h5>
                        <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-3 mt-2">{{ $notif->message }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted"><i class="fas fa-user-tie"></i> De : Service Commercial</small>
                        
                        <div class="d-flex gap-2">
                            <!-- BOUTON 'VU' (Seulement si pas encore lu) -->
                            @if(!$notif->lu)
                                <form action="{{ route('clients.notification.read', $notif->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Marquer comme lu">
                                        <i class="fas fa-check"></i> Vu
                                    </button>
                                </form>
                            @endif

                            <!-- BOUTON RÉPONDRE -->
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#replyModal-{{ $notif->id }}">
                                <i class="fas fa-reply"></i> Répondre
                            </button>
                        </div>
                    </div>
                </div>

                <!-- MODAL DE RÉPONSE -->
                <div class="modal fade" id="replyModal-{{ $notif->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-light">
                                <h5 class="modal-title">Répondre au commercial</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('clients.notification.reply') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="sujet" value="{{ $notif->sujet }}">
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">Sujet</label>
                                        <input type="text" class="form-control" value="RE: {{ $notif->sujet }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Votre message</label>
                                        <textarea name="message" class="form-control" rows="4" placeholder="Votre réponse..." required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @empty
                <div class="list-group-item p-5 text-center text-muted">
                    <div class="display-4 mb-3">📭</div>
                    <p>Vous n'avez reçu aucun message pour le moment.</p>
                </div>
            @endforelse
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>