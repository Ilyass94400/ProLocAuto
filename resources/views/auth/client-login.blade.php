<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - ProLocAuto Co-working</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        /* Couleurs du Thème */
        :root {
            --primary-blue: #007bff; /* Bleu principal */
            --secondary-blue: #0056b3; /* Bleu foncé pour le survol */
            --background-grey: #f4f7f6; /* Gris très clair pour le fond */
            --card-white: #ffffff; /* Blanc pour la carte de connexion */
            --text-dark: #333333; /* Texte foncé */
            --input-border: #cccccc; /* Gris clair pour les bordures */
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-grey);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background-color: var(--card-white);
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 420px;
            border-top: 5px solid var(--primary-blue); /* Bandeau bleu professionnel */
        }

        .login-container h2 {
            margin-bottom: 30px;
            color: var(--primary-blue);
            font-weight: 700;
            font-size: 1.8em;
            letter-spacing: 0.5px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--text-dark);
            font-weight: 400;
            font-size: 0.9em;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--input-border);
            border-radius: 6px;
            font-size: 1em;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-sizing: border-box;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 6px;
            font-size: 1em;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            margin-top: 15px;
            text-transform: uppercase;
        }

        .login-button {
            background-color: var(--primary-blue); /* Bleu du thème */
            color: var(--card-white);
        }

        .login-button:hover {
            background-color: var(--secondary-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }

        .home-button {
            background-color: #6c757d; /* Gris pour le bouton secondaire */
            color: var(--card-white);
            margin-top: 10px;
        }

        .home-button:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(108, 117, 125, 0.3);
        }

        .footer-links {
            margin-top: 25px;
            font-size: 0.85em;
        }

        .footer-links a {
            color: var(--primary-blue);
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--secondary-blue);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion Espace Membre</h2>
        <!-- CORRECTION ICI : Utilisation de route('login') pour pointer vers la route POST /login -->
        <form action="{{ route('login') }}" method="POST"> 
            @csrf 
            <div class="input-group">
                <label for="email">E-mail Professionnel</label>
                <input type="email" id="email" name="email" placeholder="votre@email-pro.com" required>
                <!-- Afficher les erreurs si elles existent -->
                @error('email')
                    <span style="color: red; font-size: 0.8em; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
            </div>
            <button type="submit" class="login-button">Accéder à mon Espace</button>
        </form>
        <button type="button" class="home-button" onclick="location.href='/'">Retour à la page d'accueil</button>
        
        <div class="footer-links">
            <a href="#">Mot de passe oublié ?</a>
            <a href="#">Devenir Auto-entrepreneur</a>
        </div>
    </div>
</body>
</html>