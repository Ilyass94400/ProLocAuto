<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { width: 100%; max-width: 400px; padding: 20px; }
    </style>
</head>
<body>

    <div class="card bg-white shadow">
        <h3 class="text-center mb-4">Espace Admin</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.auth') }}" method="POST">
            @csrf 

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="mail" class="form-control" placeholder="sami@admin.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="motdepasse" class="form-control" placeholder="azerty" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
    </div>

</body>
</html>