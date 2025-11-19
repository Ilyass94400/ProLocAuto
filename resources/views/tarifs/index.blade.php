<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Tarifs | ProLocAuto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
    <style>
        /* Variables et styles pour la cohérence */
        :root {
            --primary-color: #007BFF;
            --background-light: #f8f9fa;
            --text-color-dark: #333;
            --border-color: #ddd;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-light);
            color: var(--text-color-dark);
        }
       
        /* Styles de la Navbar et Footer (doivent être importés de votre layout global) */
        /* ... (Ajoutez ici les styles de votre navbar et footer si vous ne les utilisez pas dans un layout) ... */

        /* --- Contenu de la Page de Tarifs --- */
        .pricing-page-container {
            max-width: 1200px;
            margin: 100px auto 50px; /* Espace en haut pour la navbar */
            padding: 40px 20px;
            text-align: center;
        }
        h1 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 2.5em;
        }
        .intro-text {
            font-size: 1.1em;
            color: #6c757d;
            margin-bottom: 50px;
        }

        /* --- Cartes de Tarifs --- */
        .pricing-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
        }
        .pricing-card {
            flex: 0 1 300px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .pricing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .pricing-card.featured {
            border-top: 5px solid var(--primary-color);
        }

        /* En-tête de la Carte */
        .card-header h2 {
            font-size: 1.8em;
            color: var(--primary-color);
            margin-top: 0;
        }
        .price {
            font-size: 3em;
            font-weight: bold;
            margin: 10px 0;
        }
        .price span {
            font-size: 0.5em;
            font-weight: normal;
            color: #6c757d;
        }
        .period {
            font-size: 0.9em;
            color: #6c757d;
            margin-bottom: 25px;
        }

        /* Caractéristiques de la Carte */
        .features-list {
            list-style: none;
            padding: 0;
            text-align: left;
            margin-bottom: 30px;
        }
        .features-list li {
            padding: 10px 0;
            border-bottom: 1px dashed #eee;
            font-size: 1em;
        }
        .features-list i {
            margin-right: 10px;
            color: #4CAF50; /* Vert pour cocher */
        }

        /* Bouton d'Action */
        .btn-select {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-select:hover {
            background-color: #0056b3;
        }

        @media (max-width: 992px) {
            .pricing-grid {
                gap: 20px;
            }
            .pricing-card {
                flex: 0 1 45%;
            }
        }
        @media (max-width: 600px) {
            .pricing-card {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    {{-- La navbar et le footer doivent être gérés par votre layout général --}}
    {{-- @include('layouts.navbar') --}}

    <div class="pricing-page-container">
        <h1>Nos Plans de Coworking Flexibles</h1>
        <p class="intro-text">Choisissez le plan ProLocAuto qui correspond le mieux à votre rythme de travail et vos besoins en communauté.</p>

        <div class="pricing-grid">
           
            <div class="pricing-card">
                <div class="card-header">
                    <h2>Nomade</h2>
                    <p class="period">Idéal pour les visites occasionnelles</p>
                </div>
               
                <div class="price">99<span>€</span></div>
                <div class="period">/mois (10 jours d'accès)</div>

                <ul class="features-list">
                    <li><i class="fas fa-check"></i> Accès Flex Desk (10 jours/mois)</li>
                    <li><i class="fas fa-check"></i> Internet Haut Débit</li>
                    <li><i class="fas fa-check"></i> Accès cuisine et café</li>
                    <li><i class="fas fa-times" style="color:#dc3545;"></i> Adresse commerciale</li>
                    <li><i class="fas fa-times" style="color:#dc3545;"></i> Salle de réunion dédiée</li>
                </ul>

                <a href="#" class="btn-select">Choisir ce plan</a>
            </div>

            <div class="pricing-card featured">
                <div class="card-header">
                    <h2>Résident</h2>
                    <p class="period">Le choix des professionnels réguliers</p>
                </div>

                <div class="price">299<span>€</span></div>
                <div class="period">/mois (Accès illimité 24/7)</div>

                <ul class="features-list">
                    <li><i class="fas fa-check"></i> **Bureau Attribué (Dédié)**</li>
                    <li><i class="fas fa-check"></i> Accès Illimité 24/7</li>
                    <li><i class="fas fa-check"></i> 5h de salles de réunion incluses</li>
                    <li><i class="fas fa-check"></i> Domiciliation d'entreprise (option)</li>
                    <li><i class="fas fa-check"></i> Imprimante Pro & Scanner</li>
                </ul>

                <a href="#" class="btn-select">Choisir ce plan</a>
            </div>

            <div class="pricing-card">
                <div class="card-header">
                    <h2>Entreprise</h2>
                    <p class="period">Pour les PME et les équipes</p>
                </div>

                <div class="price">799<span>€</span></div>
                <div class="period">/mois (Jusqu'à 4 personnes)</div>

                <ul class="features-list">
                    <li><i class="fas fa-check"></i> **Bureau Privé** (4 personnes)</li>
                    <li><i class="fas fa-check"></i> Accès Illimité 24/7</li>
                    <li><i class="fas fa-check"></i> 10h de salles de réunion incluses</li>
                    <li><i class="fas fa-check"></i> Domiciliation d'entreprise</li>
                    <li><i class="fas fa-check"></i> Réseaux et événements ProLocAuto</li>
                </ul>

                <a href="#" class="btn-select">Nous Contacter</a>
            </div>
           
        </div>
       
        <div style="margin-top: 50px; padding: 20px; background-color: #fff; border-radius: 8px;">
            <p><strong>Besoin d'une offre sur mesure ?</strong> Contactez notre équipe commerciale au +33 1 80 88 88 88 ou via la <a href="{{ route('contact') }}">page de contact</a>.</p>
        </div>
    </div>

    {{-- @include('layouts.footer') --}}
</body>
</html>
