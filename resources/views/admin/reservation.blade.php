<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle Réservation (Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

<div class="container">
    <div class="card shadow mx-auto" style="max-width: 700px;">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📅 Saisir une Réservation (Devis)</h4>
            <a href="{{ route('admin.home') }}" class="btn btn-sm btn-light">Annuler</a>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.reservation.store') }}" method="POST">
                @csrf

                <!-- 1. CHOIX DU CLIENT -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Pour quel Client ?</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Sélectionner un client --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- 2. CHOIX DE L'ANNONCE -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Quel Espace ?</label>
                    <select name="annonce_id" class="form-select" required>
                        <option value="">-- Sélectionner une annonce --</option>
                        @foreach($annonces as $annonce)
                            <option value="{{ $annonce->id }}">
                                {{ $annonce->titre }} ({{ $annonce->prix }}€ - {{ $annonce->type }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 3. DATE -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Date de début</label>
                    <input type="date" name="date_debut" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg">Valider la Réservation</button>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>