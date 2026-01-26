<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finaliser la réservation | ProLocAuto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-white shadow-sm mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">ProLocAuto</a>
            <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm">
                &larr; Retour aux offres
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h3 class="mb-0">Demande de Réservation</h3>
                        <p class="mb-0 text-white-50">Finalisez votre demande pour le commercial</p>
                    </div>
                    
                    <div class="card-body p-4">
                        
                        <!-- Récapitulatif -->
                        <div class="alert alert-light border text-center mb-4">
                            <span class="text-muted text-uppercase small fw-bold">Offre sélectionnée</span>
                            <h4 class="text-primary mt-1">{{ $annonce->titre }}</h4>
                            <div class="fs-5 fw-bold">{{ $annonce->prix }} € <small class="text-muted fw-normal">/ mois</small></div>
                        </div>

                        <!-- Affichage des erreurs de validation -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Formulaire -->
                        <form action="{{ route('client.reserver.submit', $annonce->id) }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Date de début souhaitée <span class="text-danger">*</span></label>
                                
                                <!-- ATTRIBUT 'MIN' AJOUTÉ ICI : Bloque les dates passées -->
                                <input type="date" name="date_debut" class="form-control form-control-lg" 
                                       min="{{ date('Y-m-d') }}" 
                                       value="{{ old('date_debut') }}"
                                       required>
                                
                                <div class="form-text">Quand souhaitez-vous intégrer les locaux ?</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Durée du contrat <span class="text-danger">*</span></label>
                                <select name="duree" class="form-select form-select-lg" required>
                                    <option value="" disabled selected>-- Sélectionner --</option>
                                    <option value="1 mois">1 mois (Flexible)</option>
                                    <option value="3 mois">3 mois</option>
                                    <option value="6 mois">6 mois</option>
                                    <option value="1 an">1 an (Meilleur tarif)</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Message (Facultatif)</label>
                                <textarea name="message" class="form-control" rows="4" placeholder="Ex: Bonjour, est-il possible de visiter les lieux ce jeudi ?"></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold">
                                    Envoyer ma demande 🚀
                                </button>
                                <a href="javascript:history.back()" class="btn btn-link text-muted">Annuler</a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>