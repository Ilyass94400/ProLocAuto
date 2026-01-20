<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Zone Secrète | Création Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #1a1a1a; color: #00ff00; font-family: 'Courier New', monospace; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .secret-card { background-color: #2b2b2b; border: 1px solid #00ff00; padding: 40px; width: 100%; max-width: 500px; box-shadow: 0 0 20px rgba(0, 255, 0, 0.2); }
        .form-control { background-color: #333; border: 1px solid #555; color: white; }
        .form-control:focus { background-color: #444; border-color: #00ff00; color: white; box-shadow: none; }
        .btn-secret { background-color: black; border: 1px solid #00ff00; color: #00ff00; width: 100%; padding: 10px; font-weight: bold; text-transform: uppercase; transition: 0.3s; }
        .btn-secret:hover { background-color: #00ff00; color: black; }
        label { margin-bottom: 5px; font-weight: bold; }
        .alert-success { background-color: #004400; border-color: #00ff00; color: #00ff00; }
        
        /* Style pour le nouveau bouton Admin */
        .btn-admin-go {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #00ff00;
            text-decoration: none;
            border: 1px dashed #00ff00;
            padding: 8px;
            font-size: 0.9em;
            transition: 0.3s;
        }
        .btn-admin-go:hover {
            background-color: rgba(0, 255, 0, 0.1);
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="secret-card">
        <h2 class="text-center mb-4">/// ADMIN_GENERATOR ///</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('secret.store') }}" method="POST">
            @csrf
            
            <div class="row mb-3">
                <div class="col">
                    <label>Prénom</label>
                    <input type="text" name="prenom" class="form-control" required>
                </div>
                <div class="col">
                    <label>Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label>Email Admin</label>
                <input type="email" name="mail" class="form-control" required>
            </div>

            <div class="mb-4">
                <label>Mot de passe</label>
                <input type="text" name="motdepasse" class="form-control" placeholder="Choisissez un mot de passe fort" required>
            </div>

            <button type="submit" class="btn-secret">
                > Initialiser l'Admin
            </button>
        </form>
        
        <!-- NOUVEAU BOUTON VERS ADMIN -->
        <a href="{{ route('admin.login') }}" class="btn-admin-go">
            [ ACCÉDER AU LOGIN ADMIN ]
        </a>
        
        <div class="text-center mt-3">
            <a href="/" style="color: #555; text-decoration: none; font-size: 0.8em;">Retour à la surface</a>
        </div>
    </div>

</body>
</html>