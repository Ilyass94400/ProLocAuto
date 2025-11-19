<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProLocAuto | Votre espace de coworking à Paris</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variables pour la charte graphique ProLocAuto */
        :root {
            --primary-color: #007BFF; /* Bleu ProLocAuto pour les actions et le footer */
            --secondary-color: #f8f9fa; /* Arrière-plan de section claire */
            --text-color-light: #f8f9fa; 
            --text-color-dark: #333; 
            --navbar-bg: rgba(255, 255, 255, 0.9); 
            --button-bg: #17a2b8; /* Cyan pour le bouton principal */
            --button-hover-bg: #138496;
            --card-bg: #f5f5f5; /* Arrière-plan des cartes d'avantages */
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: var(--text-color-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- NAVIGATION BAR --- */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            background-color: var(--navbar-bg);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: fixed; 
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            box-sizing: border-box;
        }

        .navbar .logo {
            font-size: 1.8em;
            font-weight: bold;
            color: var(--primary-color);
            text-decoration: none;
        }

        .navbar-links a {
            color: var(--text-color-dark);
            text-decoration: none;
            margin-left: 25px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-links a:hover {
            color: var(--primary-color);
        }

        .navbar-links .btn-connexion {
            background-color: var(--primary-color);
            color: white;
            padding: 8px 18px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar-links .btn-connexion:hover {
            background-color: #0056b3;
        }

        /* --- HERO SECTION (IMAGE DE FOND) --- */
        .hero-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: var(--text-color-light); 
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('{{ asset('images/coworking-background.jpg') }}') no-repeat center center fixed; 
            background-size: cover; 
            padding: 150px 20px; 
            margin-top: 70px;
        }

        .hero-section h1 {
            font-size: 3.5em;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .hero-section p {
            font-size: 1.5em;
            margin-bottom: 40px;
            max-width: 800px;
        }

        .hero-section .btn-join {
            background-color: var(--button-bg);
            color: white;
            padding: 15px 35px;
            border-radius: 50px; 
            text-decoration: none;
            font-size: 1.2em;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .hero-section .btn-join:hover {
            background-color: var(--button-hover-bg);
            transform: translateY(-2px); 
        }

        /* --- WHY CHOOSE US SECTION (AVANTAGES) --- */
        .why-choose-us {
            padding: 80px 40px;
            background-color: #fff;
            text-align: center;
        }

        .why-choose-us h2 {
            font-size: 2em;
            margin-bottom: 50px;
            color: var(--text-color-dark);
        }

        .cards-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap; /* Assure la flexibilité sur les petits écrans */
        }

        .card {
            flex: 0 1 300px; /* Taille flexible pour les cartes */
            background-color: var(--card-bg);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            font-size: 1.25em;
            color: var(--text-color-dark);
            margin-top: 0;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 0.95em;
            color: #6c757d;
            line-height: 1.5;
        }

        /* --- FOOTER --- */
        .main-footer {
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 0.9em;
            margin-top: auto; /* Pousse le footer vers le bas */
        }


        /* --- MEDIA QUERIES --- */
        @media (max-width: 992px) {
            .cards-container {
                gap: 20px;
            }
            .card {
                flex: 0 1 45%; /* Deux cartes par ligne */
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px 20px;
            }
            .navbar-links {
                margin-top: 15px;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }
            .navbar-links a {
                margin: 0;
            }
            .hero-section {
                padding: 80px 15px;
                margin-top: 150px;
            }
            .hero-section h1 {
                font-size: 2.5em;
            }
            .hero-section p {
                font-size: 1.2em;
            }
            .why-choose-us {
                padding: 50px 20px;
            }
            .card {
                flex: 0 1 100%; /* Une carte par ligne sur mobile */
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ url('/') }}" class="logo">ProLocAuto</a>
        <div class="navbar-links">
            <a href="{{ url('/') }}">Accueil</a>
            <a href="{{ route('offers.index') }}">Espaces</a>
            <a href="{{ url('/tarifs') }}">Tarifs</a>
            <a href="{{ url('/contact') }}">Contact</a>
            <a href="{{ url('/avis') }}">Avis</a>
            <a href="{{ route('login') }}" class="btn-connexion">Connexion</a>
        </div>
    </nav>

    <main>
        <section class="hero-section">
            <h1>Bienvenue chez ProLocAuto</h1>
            <p>Votre espace de coworking moderne et inspirant à Paris. Travaillez mieux, ensemble.</p>
            <a href="{{ route('register.form') }}" class="btn-join">Rejoindre la communauté</a>
        </section>

        <section class="why-choose-us">
            <h2>Pourquoi choisir ProLocAuto ?</h2>
            <div class="cards-container">
                
                <div class="card">
                    <h3>Espaces modernes</h3>
                    <p>Bureaux équipés, open spaces et salles de réunion confortables.</p>
                </div>

                <div class="card">
                    <h3>Connexion ultra-rapide</h3>
                    <p>Profitez d'une connexion internet haut débit stable et sécurisée.</p>
                </div>

                <div class="card">
                    <h3>Communauté active</h3>
                    <p>Rencontrez des entrepreneurs, freelances et startups inspirants.</p>
                </div>

            </div>
        </section>
    </main>

    <footer class="main-footer">
        © 2025 ProLocAuto. Tous droits réservés.
    </footer>

</body>
</html>
