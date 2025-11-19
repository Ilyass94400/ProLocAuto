<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace | ProLocAuto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Variables et styles généraux (Navbar, body, footer, cards, etc.) */
        :root {
            --primary-color: #007BFF;
            --background-light: #f4f7f6;
            --button-bg: #17a2b8;
            --text-color-dark: #333;
            --text-color-light: #f8f9fa;
            --navbar-bg: rgba(255, 255, 255, 0.9);
            --border-color: #ddd;
            --card-bg: #f5f5f5;
            --button-hover-bg: #138496;
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

        /* --- NAVIGATION BAR (RÉUTILISATION DU STYLE PRÉCÉDENT) --- */
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
        /* Styles pour les liens Auth */
        .navbar-links .btn-deconnexion,
        .navbar-links .btn-inscription {
            background-color: #dc3545; 
            color: white;
            padding: 8px 18px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            text-decoration: none; 
            font-weight: 500;
        }
        .navbar-links .btn-deconnexion { background-color: #dc3545; }
        .navbar-links .btn-deconnexion:hover { background-color: #c82333; }
        .navbar-links .btn-inscription { background-color: var(--button-bg); margin-left: 25px; }
        .navbar-links .btn-inscription:hover { background-color: var(--button-hover-bg); }
        .navbar-links form button { margin-left: 25px; }


        /* --- BANDEAU DE PROFIL UNIQUE --- */
        .profile-banner {
            background-color: var(--background-light);
            color: var(--text-color-dark);
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            margin-top: 70px; /* Espace pour la navbar fixe */
        }
        .profile-banner h2 {
            font-size: 1.5em;
            margin: 0;
            font-weight: 500;
        }
        .profile-banner h2 span {
            color: var(--primary-color);
            font-weight: bold;
        }
        .profile-info {
            font-size: 0.9em;
        }
        .profile-info i {
            margin-right: 8px;
            color: var(--primary-color);
        }

        /* --- HERO SECTION (AVEC IMAGE) --- */
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
            padding: 100px 20px; 
            flex-grow: 1; 
        }
        .hero-section h1 { font-size: 3.5em; margin-bottom: 20px; font-weight: bold; }
        .hero-section p { font-size: 1.5em; margin-bottom: 40px; max-width: 800px; }
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

        .why-choose-us {
            padding: 80px 40px;
            background-color: #fff;
            text-align: center;
        }
        .why-choose-us h2 { font-size: 2em; margin-bottom: 50px; color: var(--text-color-dark); }
        .cards-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap; 
        }
        .card {
            flex: 0 1 300px;
            background-color: var(--card-bg);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        .card:hover { transform: translateY(-5px); }
        .card h3 { font-size: 1.25em; color: var(--text-color-dark); margin-top: 0; margin-bottom: 15px; }
        .card p { font-size: 0.95em; color: #6c757d; line-height: 1.5; }

        /* --- FOOTER --- */
        .main-footer {
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 0.9em;
            margin-top: auto; 
        }

        /* --- MEDIA QUERIES --- */
        @media (max-width: 992px) {
            .cards-container { gap: 20px; }
            .card { flex: 0 1 45%; }
        }
        @media (max-width: 768px) {
            .navbar { flex-direction: column; padding: 15px 20px; }
            .navbar-links { margin-top: 15px; display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; }
            .navbar-links a { margin: 0; }
            .hero-section { padding: 80px 15px; }
            .hero-section h1 { font-size: 2.5em; }
            .hero-section p { font-size: 1.2em; }
            .why-choose-us { padding: 50px 20px; }
            .card { flex: 0 1 100%; margin-bottom: 15px; }
            .profile-banner { flex-direction: column; align-items: flex-start; margin-top: 150px; }
            .profile-info { margin-top: 10px; }
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

            @auth
                {{-- Utilisateur connecté : Afficher Mon Compte et Déconnexion --}}
                <a href="{{ route('clients.mon-compte') }}">Mon Compte</a> 
                
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-deconnexion">Déconnexion</button>
                </form>
            @else
                {{-- Utilisateur non connecté : Afficher Connexion et Inscription --}}
                <a href="{{ route('login') }}" class="btn-connexion">Connexion</a>
                <a href="{{ route('register.form') }}" class="btn-inscription">Inscription</a>
            @endauth
        </div>
    </nav>

    {{-- BANDEAU DE PROFIL : Affiche les infos du client passé par le contrôleur --}}
    <div class="profile-banner">
        <h2>Bienvenue, <span>{{ $client->name }}</span> !</h2>
        <div class="profile-info">
            <i class="fas fa-envelope"></i> {{ $client->email }}
            @if(isset($client->company_name) && $client->company_name)
                | <i class="fas fa-building"></i> {{ $client->company_name }}
            @endif
        </div>
    </div>
    
    <main>
        <section class="hero-section">
            <h1>Espace Client ProLocAuto</h1>
            <p>Accédez rapidement à vos réservations, factures et paramètres de profil.</p>
            <a href="{{ route('offers.index') }}" class="btn-join">Réserver un espace</a>
        </section>

        <section class="why-choose-us">
            <h2>Actions Rapides</h2>
            <div class="cards-container">
                
                <div class="card">
                    <h3>Mes Réservations</h3>
                    <p>Consultez, modifiez ou annulez vos réservations d'espaces à venir.</p>
                </div>

                <div class="card">
                    <h3>Gérer mon Profil</h3>
                    <p>Mettez à jour vos informations personnelles et votre mot de passe.</p>
                </div>

                <div class="card">
                    <h3>Facturation et Paiements</h3>
                    <p>Téléchargez vos factures et gérez vos méthodes de paiement.</p>
                </div>

            </div>
        </section>
    </main>

    <footer class="main-footer">
        © 2025 ProLocAuto. Tous droits réservés.
    </footer>

</body>
</html>
