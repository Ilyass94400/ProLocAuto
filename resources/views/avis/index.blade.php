<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avis Clients | ProLocAuto</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #0d6efd;
            --secondary: #6c757d;
            --bg-light: #f8f9fa;
            --star-color: #ffc107;
        }
        
        body {
            background-color: var(--bg-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* En-tête avec stats */
        .stats-badge {
            background: white;
            padding: 15px 30px;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            display: inline-flex;
            align-items: center;
            gap: 20px;
        }

        /* Formulaire Sticky (reste visible quand on scroll) */
        .sticky-form {
            position: sticky;
            top: 40px; /* Marge du haut */
            z-index: 10;
        }

        /* Cartes Avis */
        .review-card {
            background: white;
            border: none;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            transition: transform 0.2s;
        }
        .review-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        /* Avatar coloré aléatoire (simulation) */
        .avatar-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 1.2rem;
        }

        /* Bouton Retour */
        .btn-back {
            position: absolute;
            top: 20px;
            left: 20px;
            text-decoration: none;
            color: #555;
            font-weight: 600;
            background: white;
            padding: 8px 15px;
            border-radius: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .btn-back:hover {
            background: var(--primary);
            color: white;
        }
    </style>
</head>
<body>

    <!-- Bouton Retour -->
    <a href="{{ route('clients.accueil') }}" class="btn-back">
        <i class="fas fa-arrow-left me-2"></i> Accueil
    </a>

    <div class="container py-5 mt-4">
        
        <!-- SECTION EN-TÊTE -->
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary mb-3">L'avis de notre communauté</h1>
            <p class="lead text-muted mb-4">Découvrez les expériences de nos coworkers.</p>
            
            <div class="stats-badge">
                <div class="display-4 fw-bold text-dark lh-1">
                    {{ number_format($noteMoyenne, 1) }}
                </div>
                <div class="text-start">
                    <div class="text-warning fs-5">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="{{ $i <= round($noteMoyenne) ? 'fas' : 'far' }} fa-star"></i>
                        @endfor
                    </div>
                    <div class="text-muted small">{{ $avis->count() }} avis vérifiés</div>
                </div>
            </div>
        </div>

        <div class="row g-5">
            
            <!-- COLONNE GAUCHE : FORMULAIRE -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-form">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">Partagez votre avis</h4>
                        <p class="text-muted small mb-4">Votre retour nous aide à améliorer nos espaces.</p>

                        <!-- Messages Flash -->
                        @if(session('success'))
                            <div class="alert alert-success py-2 small">
                                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 small">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Logique Auth -->
                        @auth
                            <form action="{{ route('avis.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-uppercase text-muted">Votre nom</label>
                                    <input type="text" name="name" class="form-control bg-light" value="{{ Auth::user()->name }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-uppercase text-muted">Note</label>
                                    <select name="rating" class="form-select" required>
                                        <option value="" disabled selected>Choisir...</option>
                                        <option value="5">⭐⭐⭐⭐⭐ Excellent (5)</option>
                                        <option value="4">⭐⭐⭐⭐ Très bien (4)</option>
                                        <option value="3">⭐⭐⭐ Bien (3)</option>
                                        <option value="2">⭐⭐ Moyen (2)</option>
                                        <option value="1">⭐ Déçu (1)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-uppercase text-muted">Commentaire</label>
                                    <textarea name="comment" class="form-control" rows="4" placeholder="Votre expérience..." required>{{ old('comment') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Publier</button>
                            </form>
                        @else
                            <div class="text-center py-4 bg-light rounded">
                                <i class="fas fa-lock text-warning fs-1 mb-3"></i>
                                <h6 class="fw-bold">Connexion requise</h6>
                                <p class="text-muted small px-3">Connectez-vous pour laisser un avis authentique.</p>
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Se connecter</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- COLONNE DROITE : LISTE DES AVIS -->
            <div class="col-lg-8">
                <h5 class="fw-bold mb-4 pb-2 border-bottom">Derniers avis publiés</h5>

                <div class="d-flex flex-column gap-3">
                    @forelse ($avis as $index => $serviceAvis)
                        <div class="review-card">
                            <div class="d-flex">
                                <!-- Avatar avec couleur dynamique basée sur l'index -->
                                <div class="flex-shrink-0 me-3">
                                    @php
                                        $colors = ['#0d6efd', '#6610f2', '#6f42c1', '#d63384', '#fd7e14', '#198754'];
                                        $color = $colors[$index % count($colors)];
                                    @endphp
                                    <div class="avatar-circle" style="background-color: {{ $color }};">
                                        {{ strtoupper(substr($serviceAvis->auteur_nom ?? 'A', 0, 1)) }}
                                    </div>
                                </div>
                                
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0 fw-bold">{{ $serviceAvis->auteur_nom ?? 'Utilisateur' }}</h6>
                                        <small class="text-muted">{{ $serviceAvis->created_at->diffForHumans() }}</small>
                                    </div>
                                    
                                    <div class="mb-2 text-warning small">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= $serviceAvis->note ? 'fas' : 'far text-secondary opacity-25' }} fa-star"></i>
                                        @endfor
                                    </div>
                                    
                                    <p class="text-secondary mb-0" style="font-size: 0.95rem; line-height: 1.5;">
                                        {{ $serviceAvis->commentaire }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted bg-white rounded shadow-sm">
                            <i class="far fa-comment-dots display-1 mb-3 opacity-25"></i>
                            <h4>Aucun avis pour le moment</h4>
                            <p>Soyez le premier à partager votre expérience !</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

</body>
</html>