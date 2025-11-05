<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte | ProLocAuto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
    <style>
        /* Styles de base - ASSUREZ-VOUS QUE CES STYLES CORRESPONDENT À VOS VUES EXISTANTES */
        :root { --primary-color: #007BFF; }
        body { font-family: 'Arial', sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; }
       
        /* Navbar (doit être cohérente avec image_438fa6.jpg) */
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 15px 50px; background-color: white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); }
        .navbar .logo { font-size: 1.8em; font-weight: bold; color: var(--primary-color); text-decoration: none; }
        .navbar-links a { margin-left: 20px; text-decoration: none; color: #333; font-weight: 500; }
        .btn-deconnexion { background-color: #dc3545; color: white; padding: 8px 15px; border-radius: 5px; border: none; cursor: pointer; }

        /* Contenu de la page */
        .account-container { max-width: 1200px; margin: 100px auto 50px; padding: 0 20px; }
        h1 { color: var(--primary-color); border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 30px; }
        .dashboard-grid { display: grid; grid-template-columns: 1fr 3fr; gap: 30px; }

        /* Menu latéral (Navigation Mon Compte) */
        .sidebar-menu { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); height: fit-content; }
        .sidebar-menu a { display: block; padding: 10px 0; text-decoration: none; color: #555; border-bottom: 1px solid #eee; }
        .sidebar-menu a:hover { color: var(--primary-color); }
        .sidebar-menu a:last-child { border-bottom: none; }
       
        /* Contenu principal */
        .main-content { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); }
        .info-card { background-color: #f1f8ff; padding: 20px; border-radius: 6px; margin-bottom: 20px; border-left: 5px solid var(--primary-color); }
        .info-card h2 { margin-top: 0; color: #333; font-size: 1.4em; }
        .info-card p { margin: 5px 0; font-size: 1.1em; }

        @media (max-width: 900px) {
            .dashboard-grid { grid-template-columns: 1fr; }
            .navbar { flex-direction: column; }
        }
    </style>
</head>
<body>
   
    {{-- BARRE DE NAVIGATION CLIENT (doit être extraite de votre layout) --}}
    <nav class="navbar">
        {{-- Lien Logo conditionnel --}}
        <a href="{{ route('clients.accueil') }}" class="logo">ProLocAuto</a>
       
        <div class="navbar-links">
            <a href="{{ route('clients.accueil') }}">Accueil</a>
            <a href="#">Espaces</a>
            <a href="#">Tarifs</a>
            <a href="{{ route('contact') }}">Contact</a>
           
            {{-- Le lien "Mon Compte" DOIT maintenant pointer vers la nouvelle route --}}
            <a href="{{ route('clients.mon-compte') }}">Mon Compte</a>
           
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-deconnexion">Déconnexion</button>
            </form>
        </div>
    </nav>
    {{-- FIN BARRE DE NAVIGATION --}}

    <div class="account-container">
        <h1>Mon Compte</h1>

        <div class="dashboard-grid">
           
            {{-- Menu latéral de navigation --}}
            <div class="sidebar-menu">
                <a href="{{ route('clients.mon-compte') }}">Tableau de bord</a>
                <a href="#">Mes Réservations</a>
                <a href="#">Mes Factures</a>
                <a href="#">Modifier le Profil</a>
                <a href="#">Sécurité</a>
            </div>

            {{-- Contenu principal --}}
            <div class="main-content">
                <h2>Bienvenue sur votre Espace Client, {{ $client->name ?? 'Client' }} !</h2>
               
                <div class="info-card">
                    <h2>Dernières Réservations</h2>
                    {{-- Ici, bouclez sur les 5 dernières réservations --}}
                    <p>Aucune réservation récente trouvée. <a href="#">Réserver un espace</a></p>
                </div>

                <div class="info-card">
                    <h2>Factures Récentes</h2>
                    {{-- Ici, bouclez sur les 5 dernières factures --}}
                    <p>Aucune facture en attente de paiement. <a href="#">Consulter tout</a></p>
                </div>
               
                <div class="info-card">
                    <h2>Détails du Profil</h2>
                    <p>Email: <strong>{{ $client->email }}</strong></p>
                    <p>Statut: **Membre ProLocAuto**</p>
                    <p><a href="#">Mettre à jour vos informations</a></p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
