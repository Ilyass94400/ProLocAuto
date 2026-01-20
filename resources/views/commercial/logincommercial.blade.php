<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Commercial | ProLocAuto</title>
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h2 {
            color: #333;
            font-weight: 700;
        }
        .login-header p {
            color: #777;
        }
        .btn-custom {
            background-color: #2c3e50; /* Couleur sombre pro */
            color: white;
            font-weight: 600;
        }
        .btn-custom:hover {
            background-color: #1a252f;
            color: white;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <h2>Espace Pro</h2>
            <p>Connexion Commercial</p>
        </div>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('commercial.login.submit') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold">Email professionnel</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="nom@prolocauto.com" required autofocus>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Mot de passe</label>
                <input type="password" name="password" class="form-control form-control-lg" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-custom btn-lg">Se connecter</button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="/" class="text-decoration-none text-muted small">&larr; Retour au site</a>
        </div>
    </div>

</body>
</html>