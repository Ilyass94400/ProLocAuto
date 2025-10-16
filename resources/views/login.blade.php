<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | ProLocAuto</title>

    <style>
        /* ======= STYLE GLOBAL ======= */
        body {
            font-family: 'Poppins', sans-serif;
            background: url('/images/coworking-bg.jpg') center/cover no-repeat;
            margin: 0;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }

        .login-container {
            position: relative;
            z-index: 1;
            background: #fff;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0077b6;
            margin-bottom: 15px;
        }

        .login-container h2 {
            color: #333;
            margin-bottom: 25px;
        }

        /* ======= FORM ======= */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #0077b6;
            outline: none;
        }

        .btn-primary {
            background: #0077b6;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #023e8a;
        }

        .links {
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .links a {
            color: #0077b6;
            text-decoration: none;
            font-weight: 500;
        }

        .links a:hover {
            text-decoration: underline;
        }

        /* ======= RESPONSIVE ======= */
        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="logo">ProLocAuto</div>
        <h2>Connexion à votre espace</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="email" placeholder="Adresse e-mail" required autofocus>
            <input type="password" name="password" placeholder="Mot de passe" required>

            <button type="submit" class="btn-primary">Se connecter</button>
        </form>

        <div class="links">
            <p>Pas encore de compte ? 
                <a href="{{ route('register') }}">Créer un compte</a>
            </p>
        </div>
    </div>

</body>
</html>
