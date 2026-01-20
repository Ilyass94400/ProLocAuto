<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Client | ProLocAuto</title>
    <!-- Importation de Bootstrap pour le style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- CSS Personnalisé -->
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-login {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .card-header {
            background-color: #0d6efd; /* Bleu Bootstrap */
            color: white;
            text-align: center;
            padding: 20px;
            border-bottom: none;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: #0d6efd;
        }
        .btn-login {
            background-color: #0d6efd;
            border: none;
            padding: 12px;
            font-weight: bold;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            
            <!-- Lien retour accueil -->
            <div class="text-center mb-4">
                <a href="/" class="text-decoration-none text-secondary fw-bold">
                    &larr; Retour à l'accueil ProLocAuto
                </a>
            </div>

            <div class="card card-login">
                <div class="card-header">
                    <h3 class="mb-0">Espace Client</h3>
                    <p class="mb-0 opacity-75">Connectez-vous à votre compte</p>
                </div>

                <div class="card-body p-4">
                    
                    <!-- Affichage des erreurs de validation (ex: mot de passe faux) -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Message de statut (ex: "Vous êtes déconnecté") -->
                    @if (session('status'))
                        <div class="alert alert-success small">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- LE FORMULAIRE CORRIGÉ -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf <!-- Sécurité obligatoire -->

                        <!-- Champ Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label text-muted small fw-bold">ADRESSE EMAIL</label>
                            <input type="email" 
                                   class="form-control form-control-lg" 
                                   name="email" 
                                   id="email" 
                                   placeholder="exemple@email.com" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus>
                        </div>

                        <!-- Champ Mot de passe -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label text-muted small fw-bold">MOT DE PASSE</label>
                                <!-- Lien mot de passe oublié (optionnel) -->
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none small">Oublié ?</a>
                                @endif
                            </div>
                            <input type="password" 
                                   class="form-control form-control-lg" 
                                   name="password" 
                                   id="password" 
                                   placeholder="Votre mot de passe" 
                                   required>
                        </div>

                        <!-- Case "Se souvenir de moi" -->
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                            <label class="form-check-label small text-secondary" for="remember_me">Se souvenir de moi</label>
                        </div>

                        <!-- Bouton de validation -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-login text-white">
                                Se connecter
                            </button>
                        </div>

                    </form>
                </div>

                <!-- Pied de carte : Lien vers inscription -->
                <div class="card-footer bg-light text-center py-3">
                    <p class="mb-0 small text-muted">
                        Pas encore de compte ? 
                        <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Créer un compte</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>