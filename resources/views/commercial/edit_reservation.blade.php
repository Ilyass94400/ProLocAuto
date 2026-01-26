<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer la Réservation | ProLocAuto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        
        <!-- BLOC DE DEMANDE CLIENT (Visible seulement si demande en cours) -->
        @if($reservation->statut == 'En attente de modification')
            <div class="card shadow border-warning mb-4">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Demande de modification du client</h5>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold">Message du client :</h6>
                    <div class="alert alert-light border">
                        @if(isset($messageClient))
                            {{-- On nettoie un peu le message pour enlever le texte automatique --}}
                            {!! nl2br(e(str_replace("Le client souhaite modifier sa réservation pour l'espace : " . $reservation->annonce->titre . ".\n\nDétails de la demande :\n", "", $messageClient->message))) !!}
                        @else
                            <em class="text-muted">Message non trouvé, vérifiez la messagerie.</em>
                        @endif
                    </div>
                    
                    <p class="small text-muted mb-0">
                        <strong>Action requise :</strong> Pour accepter, modifiez les champs ci-dessous (Date/Durée) et cliquez sur "Valider".<br>
                        Sinon, cliquez sur "Refuser la demande".
                    </p>
                </div>
                <div class="card-footer bg-white text-end">
                    <!-- BOUTON REFUSER LA DEMANDE -->
                    <form action="{{ route('commercial.modif.refuser', $reservation->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir refuser cette demande ?')">
                            <i class="fas fa-times"></i> Refuser la demande
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <!-- FORMULAIRE DE MODIFICATION (Pour Accepter ou juste éditer) -->
        <div class="card shadow border-0 mx-auto">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Détails de la réservation #{{ $reservation->id }}</h5>
            </div>
            <div class="card-body p-4">
                
                <form action="{{ route('commercial.reservations.update', $reservation->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Client</label>
                            <input type="text" class="form-control bg-light" value="{{ $reservation->user->name ?? '?' }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Espace</label>
                            <input type="text" class="form-control bg-light" value="{{ $reservation->annonce->titre ?? '?' }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-primary">Date de début</label>
                            <!-- C'est ici que le commercial change la date si il accepte -->
                            <input type="date" name="date_debut" class="form-control border-primary" value="{{ $reservation->date_debut->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-primary">Durée</label>
                            <select name="duree" class="form-select border-primary">
                                <option value="1 mois" {{ $reservation->duree == '1 mois' ? 'selected' : '' }}>1 mois</option>
                                <option value="3 mois" {{ $reservation->duree == '3 mois' ? 'selected' : '' }}>3 mois</option>
                                <option value="6 mois" {{ $reservation->duree == '6 mois' ? 'selected' : '' }}>6 mois</option>
                                <option value="1 an" {{ $reservation->duree == '1 an' ? 'selected' : '' }}>1 an</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Prix (€)</label>
                            <input type="number" name="prix" class="form-control" value="{{ $reservation->prix }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Statut</label>
                            <select name="statut" class="form-select">
                                <option value="Confirmée" {{ $reservation->statut == 'Confirmée' ? 'selected' : '' }}>Confirmée (Actif)</option>
                                <option value="En attente de modification" {{ $reservation->statut == 'En attente de modification' ? 'selected' : '' }}>En attente de modification</option>
                                <option value="Modification refusée" {{ $reservation->statut == 'Modification refusée' ? 'selected' : '' }}>Modification refusée</option>
                                <option value="Payée" {{ $reservation->statut == 'Payée' ? 'selected' : '' }}>Payée</option>
                                <option value="Annulée" {{ $reservation->statut == 'Annulée' ? 'selected' : '' }}>Annulée</option>
                                <option value="Terminée" {{ $reservation->statut == 'Terminée' ? 'selected' : '' }}>Terminée</option>
                            </select>
                            <div class="form-text">Si vous acceptez la demande, repassez le statut en <strong>Confirmée</strong>.</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4 border-top pt-3">
                        <a href="{{ route('commercial.dashboard') }}" class="btn btn-secondary">Annuler / Retour</a>
                        
                        <!-- BOUTON ACCEPTER / ENREGISTRER -->
                        <button type="submit" class="btn btn-success fw-bold px-4">
                            <i class="fas fa-save me-2"></i> Enregistrer / Valider la modification
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>