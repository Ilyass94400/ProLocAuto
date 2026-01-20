<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau Message | Commercial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow border-0" style="max-width: 600px; margin: 0 auto;">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Envoyer un message à un client</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('commercial.message.send') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Destinataire</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">-- Choisir un client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Sujet</label>
                        <input type="text" name="sujet" class="form-control" placeholder="Ex: Concernant votre réservation" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Message</label>
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('commercial.dashboard') }}" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-success">Envoyer 🚀</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>