<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accès Restreint</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #212529; color: white; height: 100vh; display: flex; align-items: center; justify-content: center; font-family: monospace; }
        .gate-card { background: #000; border: 1px solid #dc3545; padding: 40px; border-radius: 10px; width: 100%; max-width: 400px; text-align: center; box-shadow: 0 0 20px rgba(220, 53, 69, 0.5); }
        .form-control { background: #333; border: 1px solid #555; color: white; text-align: center; font-size: 1.5rem; letter-spacing: 5px; text-transform: uppercase; }
        .form-control:focus { background: #444; color: white; border-color: #dc3545; box-shadow: 0 0 10px rgba(220, 53, 69, 0.5); }
        .btn-gate { background: #dc3545; border: none; color: white; width: 100%; padding: 10px; font-weight: bold; margin-top: 20px; transition: 0.3s; }
        .btn-gate:hover { background: #b02a37; }
    </style>
</head>
<body>

    <div class="gate-card">
        <h3 class="mb-4">🔒 ZONE RESTREINTE</h3>
        <p class="text-secondary small mb-4">Veuillez entrer le code de sécurité pour accéder à l'administration.</p>

        @if(session('error'))
            <div class="alert alert-danger py-2 small">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.gate.verify') }}" method="POST">
            @csrf
            <input type="password" name="code" class="form-control" placeholder="••••••••" required autofocus autocomplete="off">
            <button type="submit" class="btn-gate">DÉVERROUILLER</button>
        </form>
    </div>

</body>
</html>