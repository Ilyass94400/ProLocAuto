<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Envoyer un message | Commercial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow border-0" style="max-width: 700px; margin: 0 auto;">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">✉️ Rédiger un nouveau message</h5>
            </div>
            <div class="card-body p-4">
                
                <form action="{{ route('commercial.message.send') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Destinataire (Client)</label>
                        <select name="user_id" class="form-select form-select-lg" required>
                            <option value="">-- Sélectionner un client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">
                                    {{ $client->name }} ({{ $client->email }})
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Le message apparaîtra dans l'espace "Mon Compte" du client.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Sujet</label>
                        <input type="text" name="sujet" class="form-control" placeholder="Ex: Confirmation de votre dossier" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Message</label>
                        <textarea name="message" class="form-control" rows="6" placeholder="Bonjour..." required></textarea>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('commercial.messagerie') }}" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-success btn-lg px-5">Envoyer le message</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>