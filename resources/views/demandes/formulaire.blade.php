<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Finaliser la réservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container">
    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            <h3>Réserver : {{ $annonce->titre }}</h3>
        </div>
        <div class="card-body">
            <p>Prix : <strong>{{ $annonce->prix }} €/mois</strong></p>
            
            <form action="{{ route('client.reserver.submit', $annonce->id) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label>Date de début :</label>
                    <input type="date" name="date_debut" class="form-control" min="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-3">
                    <label>Durée :</label>
                    <select name="duree" class="form-select" required>
                        <option value="1 mois">1 mois</option>
                        <option value="3 mois">3 mois</option>
                        <option value="6 mois">6 mois</option>
                        <option value="1 an">1 an</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Message (Optionnel) :</label>
                    <textarea name="message" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success w-100">Envoyer la demande</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>