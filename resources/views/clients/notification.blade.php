<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('clients.mon-compte') }}" class="btn btn-outline-secondary me-3">Retour</a>
            <h1 class="mb-0">Mes Notifications</h1>
        </div>

        <div class="list-group shadow-sm">
            @forelse($notifications as $notif)
                <div class="list-group-item p-4">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 text-primary">{{ $notif->sujet }}</h5>
                        <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1 mt-2">{{ $notif->message }}</p>
                    <small class="text-muted">De : Service Commercial</small>
                </div>
            @empty
                <div class="list-group-item p-5 text-center text-muted">
                    <h4>📭</h4>
                    <p>Vous n'avez reçu aucun message pour le moment.</p>
                </div>
            @endforelse
        </div>

    </div>

</body>
</html>