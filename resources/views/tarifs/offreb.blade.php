<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres Résident (Type 2) | ProLocAuto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card-annonce { transition: transform 0.3s; }
        .card-annonce:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-white shadow-sm mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="/">ProLocAuto</a>
            <a href="{{ route('tarif') }}" class="btn btn-outline-secondary btn-sm">
                &larr; Retour aux Tarifs
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-success">Nos Espaces "Résident"</h1>
            <p class="lead text-muted">Des bureaux dédiés pour les professionnels réguliers (Type 2)</p>
        </div>

        <div class="row">
            @forelse($annonces as $annonce)
                <div class="col-md-4 mb-4">
                    <div class="card card-annonce h-100 shadow-sm border-0">
                        <!-- En-tête VERT pour le Type 2 -->
                        <div class="card-header bg-success text-white text-center py-3">
                            <h4 class="my-0 fw-normal">{{ $annonce->titre }}</h4>
                        </div>
                        <div class="card-body d-flex flex-column text-center">
                            <h1 class="card-title pricing-card-title">
                                {{ $annonce->prix }}€ <small class="text-muted fw-light">/ mois</small>
                            </h1>
                            
                            <ul class="list-unstyled mt-3 mb-4 text-start mx-auto">
                                <li>{{ $annonce->description }}</li>
                            </ul>
                            
                            <div class="mt-auto w-100">
                                <!-- Lien vers la page contact -->
                                <a href="{{ route('contact') }}" class="btn w-100 btn-lg btn-outline-success">
                                    Réserver ce bureau
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="alert alert-success text-center py-5" style="background-color: #d1e7dd; border-color: #badbcc; color: #0f5132;">
                        <h4>Aucune offre "Résident" pour le moment.</h4>
                        <p>De nouveaux bureaux seront bientôt disponibles.</p>
                        <a href="{{ route('tarif') }}" class="btn btn-success mt-3">Voir les autres offres</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>