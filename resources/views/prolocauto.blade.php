<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProLocAuto | Coworking & Espaces Professionnels</title>

    <style>
        /* ======= STYLE PROLOCAUTO ======= */
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9f9f9;
            margin: 0;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* HEADER */
        .header {
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            font-size: 1.6rem;
            font-weight: 700;
            color: #0077b6;
        }

        .nav a {
            text-decoration: none;
            color: #333;
            margin: 0 12px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav a:hover {
            color: #0077b6;
        }

        .btn-login {
            background: #0077b6;
            color: #fff !important;
            padding: 8px 15px;
            border-radius: 5px;
        }

        /* HERO */
        .hero {
            position: relative;
            height: 100vh;
            background: url('/images/coworking-bg.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.55);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 650px;
        }

        .hero-content h1 {
            font-size: 2.8rem;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.1rem;
            margin-bottom: 25px;
        }

        .btn-primary {
            background: #00b4d8;
            color: #fff;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #0096c7;
        }

        /* ABOUT */
        .about {
            padding: 80px 0;
            background: #fff;
        }

        .about h3 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 50px;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .feature-card {
            background: #f1f1f1;
            padding: 30px;
            border-radius: 10px;
            flex: 1 1 250px;
            max-width: 350px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* FOOTER */
        .footer {
            background: #0077b6;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .features {
                flex-direction: column;
                align-items: center;
            }
            .hero-content h1 {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="container">
            <h1 class="logo">ProLocAuto</h1>
            <nav class="nav">
                <a href="#">Accueil</a>
                <a href="#">Espaces</a>
                <a href="#">Tarifs</a>
                <a href="#">Contact</a>
                <a href="{{ route('login') }}" class="btn-login">Connexion</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Bienvenue chez ProLocAuto</h1>
            <p>Votre espace de coworking moderne et inspirant à Paris.</p>
            <a href="{{ route('register') }}" class="btn-primary">Rejoindre la communauté</a>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <h3>Pourquoi choisir ProLocAuto ?</h3>
            <div class="features">
                <div class="feature-card">
                    <h4>Espaces modernes</h4>
                    <p>Bureaux équipés, open spaces et salles de réunion confortables.</p>
                </div>
                <div class="feature-card">
                    <h4>Connexion ultra-rapide</h4>
                    <p>Profitez d’une connexion internet haut débit stable et sécurisée.</p>
                </div>
                <div class="feature-card">
                    <h4>Communauté active</h4>
                    <p>Rencontrez des entrepreneurs, freelances et startups inspirants.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} ProLocAuto. Tous droits réservés.</p>
    </footer>

</body>
</html>
