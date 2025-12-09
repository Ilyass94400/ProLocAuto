<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Saisir une Réservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

<div class="container">
    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">📅 Nouvelle Réservation (Devis)</h4>
        </div>
        <div class="card-body">
            
            <form action="{{ route('reservations.reservation.store') }}" method="POST">
                @csrf

                <!-- CHOIX DU CLIENT -->
                <div class="mb-3">
                    <label class="form-label fw-bold">1. Pour quel client ?</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Sélectionner dans la liste --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- CHOIX DE L'ANNONCE -->
                <div class="mb-3">
                    <label class="form-label fw-bold">2. Quel espace ?</label>
                    <select name="annonce_id" class="form-select" required>
                        <option value="">-- Sélectionner un bureau --</option>
                        @foreach($annonces as $annonce)
                            <option value="{{ $annonce->id }}">
                                {{ $annonce->titre }} ({{ $annonce->prix }} €)
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- CHOIX DE LA DATE -->
                <div class="mb-4">
                    <label class="form-label fw-bold">3. Date de début</label>
                    <input type="date" name="date_debut" class="form-control" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-lg">Valider la Réservation</button>
                    <a href="{{ route('admin.home') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>