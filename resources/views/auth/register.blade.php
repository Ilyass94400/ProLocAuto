<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | ProLocAuto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Variables pour la charte graphique ProLocAuto */
        :root {
            --primary-color: #007BFF; /* Bleu ProLocAuto pour les actions */
            --secondary-color: #4CAF50; /* Vert pour la validation (optionnel) */
            --text-color: #333;
            --border-color: #ddd;
            --background-light: #f4f7f6;
            --shadow-light: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-light);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Conteneur principal: 2 colonnes sur desktop */
        .registration-container {
            display: flex;
            width: 90%;
            max-width: 1100px;
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--shadow-light);
            overflow: hidden;
            min-height: 700px;
        }

        /* Partie Visuelle/Image (Côté ProLocAuto) */
        .image-side {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color) 0%, #0056b3 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .image-side h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        .image-side p {
            font-size: 1.1em;
            opacity: 0.9;
            margin-bottom: 30px;
        }
        .image-side i {
            font-size: 5em;
        }

        /* Partie Formulaire */
        .form-side {
            flex: 1.2;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-side header h2 {
            font-size: 1.8em;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        .form-side header p {
            margin-bottom: 30px;
            font-size: 0.9em;
        }
        .form-side header a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
        }

        /* Styles des Groupes de Champs */
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 0.9em;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            box-sizing: border-box; 
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            border-color: var(--primary-color);
            outline: none;
        }
        .help-text {
            display: block;
            margin-top: 5px;
            font-size: 0.8em;
            color: #6c757d;
        }

        /* Gestion des erreurs de validation Laravel */
        .form-group input.is-invalid {
            border-color: #dc3545; /* Rouge d'erreur */
        }
        .error-message {
            display: block;
            color: #dc3545;
            font-size: 0.8em;
            margin-top: 5px;
            font-weight: 500;
        }

        /* Styles des Checkbox (Légal) */
        .checkbox-group {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            font-size: 0.9em;
        }
        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
            margin-top: 4px;
            min-width: 16px;
            min-height: 16px;
        }
        .checkbox-group a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        .checkbox-group a:hover {
            text-decoration: underline;
        }

        /* Bouton Principal (CTA) */
        .btn-primary {
            width: 100%;
            padding: 15px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Note de Sécurité */
        .security-note {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8em;
            color: #999;
        }
        .security-note i {
            margin-right: 5px;
        }

        /* Media Query pour Mobile (Moins de 768px) */
        @media (max-width: 768px) {
            .registration-container {
                flex-direction: column;
                width: 100%;
                min-height: auto;
                border-radius: 0;
                box-shadow: none;
            }
            .image-side {
                padding: 30px 20px;
                order: -1;
            }
            .image-side i {
                font-size: 3em;
            }
            .form-side {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<div class="registration-container">
    <div class="image-side">
        <h1>ProLocAuto</h1>
        <p>Travaillez mieux, ensemble. Créez votre compte pour accéder à nos espaces de coworking modernes et flexibles.</p>
        <i class="fas fa-key"></i>
    </div>

    <div class="form-side">
        <header>
            <h2>Créez votre compte ProLocAuto</h2>
            <p>Déjà membre ? <a href="{{ route('login') }}">Connectez-vous ici</a></p>
        </header>

        {{-- L'action du formulaire utilise la route nommée 'register' (POST /register) --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf {{-- Essentiel pour la sécurité Laravel --}}

            <div class="form-group">
                <label for="name">Nom complet</label>
                <input type="text" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}" required autofocus
                       class="@error('name') is-invalid @enderror">
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Adresse e-mail professionnelle</label>
                <input type="email" id="email" name="email" placeholder="votre.nom@entreprise.com" value="{{ old('email') }}" required
                       class="@error('email') is-invalid @enderror">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="company_name">Nom de l'entreprise (ou Freelance)</label>
                <input type="text" id="company_name" name="company_name" placeholder="Nom de votre société (Optionnel)" value="{{ old('company_name') }}">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required
                       class="@error('password') is-invalid @enderror">
                <small class="help-text">Minimum 8 caractères</small>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="cgu" name="cgu" required>
                {{-- Mettez le chemin réel de vos CGU --}}
                <label for="cgu">J'ai lu et j'accepte les <a href="#" target="_blank">CGU</a> et la <a href="#" target="_blank">Politique de Confidentialité</a>.</label>
            </div>
            
            <div class="checkbox-group">
                <input type="checkbox" id="newsletter" name="newsletter" {{ old('newsletter') ? 'checked' : '' }}>
                <label for="newsletter">Je souhaite recevoir la newsletter ProLocAuto (actus, événements).</label>
            </div>

            <button type="submit" class="btn-primary">Créer mon compte ProLocAuto</button>
            
            <p class="security-note"><i class="fas fa-lock"></i> Vos données sont sécurisées.</p>
        </form>
    </div>
</div>

</body>
</html>
