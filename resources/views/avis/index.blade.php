<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avis Clients | ProLocAuto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #007BFF;
            --secondary-color: #17a2b8;
            --background-light: #f8f9fa;
            --text-color-dark: #333;
            --star-color: #ffc107;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-light);
            color: var(--text-color-dark);
        }
        .page-container {
            max-width: 900px;
            margin: 50px auto 50px; 
            padding: 40px 20px;
            position: relative;
        }
        
        /* --- Style du bouton de retour --- */
        .back-to-home {
            position: absolute;
            top: 15px;
            left: 20px;
            text-align: left;
        }
        .btn-home {
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            transition: background-color 0.3s ease;
        }
        .btn-home:hover {
            background-color: #138496;
        }
        .btn-home i {
            margin-right: 8px;
            font-size: 1.1em;
        }
        /* --- Fin style du bouton --- */

        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-top: 50px; /* Espace pour le bouton */
            margin-bottom: 5px;
        }
        .average-rating {
            text-align: center;
            font-size: 1.5em;
            color: var(--text-color-dark);
            margin-bottom: 40px;
        }
        
        /* Style du formulaire */
        .review-form-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
            border-left: 5px solid var(--secondary-color);
        }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input[type="text"], .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        /* Style de l'affichage des avis */
        .reviews-list { padding: 0; list-style: none; }
        .review-item {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .rating-stars span { color: var(--star-color); }
        .review-item p.comment { font-style: italic; color: #555; line-height: 1.5; }
        .review-item small { color: #999; display: block; text-align: right; margin-top: 10px; }
    </style>
</head>
<body>
    
    <div class="page-container">
        
        {{-- BOUTON DE REDIRECTION VERS L'ACCUEIL --}}
        <div class="back-to-home">
            <a href="{{ route('clients.accueil') }}" class="btn-home">
                <i class="fas fa-arrow-left"></i> ProLocAuto
            </a>
        </div>
        
        <h1>Avis de notre Communauté</h1>

        @if($avis->isNotEmpty())
            <p class="average-rating">
                Note Moyenne : 
                <span>{{ number_format($noteMoyenne, 1) }}/5</span> 
                (sur {{ $avis->count() }} avis)
            </p>
        @else
            <p class="average-rating">Aucun avis n'a encore été publié.</p>
        @endif
        
        {{-- FORMULAIRE DE SOUMISSION D'AVIS (sans condition d'Auth) --}}
        <div class="review-form-container">
            <h3>Partagez votre expérience ProLocAuto</h3>
            
            @if(session('success'))
                <p style="color: green; font-weight: bold; margin-bottom: 15px;">{{ session('success') }}</p>
            @endif
            
            @if ($errors->any())
                <div style="color: red; margin-bottom: 15px;">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('avis.store') }}" method="POST">
                @csrf
                
                {{-- Champ Auteur --}}
                <div class="form-group">
                    <label for="name">Votre Nom ou Pseudo :</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                </div>

                {{-- Champ Note --}}
                <div class="form-group">
                    <label for="rating">Note (1 à 5 étoiles) :</label>
                    <select name="rating" id="rating" required>
                        <option value="">-- Sélectionner une note --</option>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                {{ str_repeat('⭐', $i) }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- Champ Commentaire --}}
                <div class="form-group">
                    <label for="comment">Votre commentaire :</label>
                    <textarea name="comment" id="comment" rows="4" required>{{ old('comment') }}</textarea>
                </div>

                <button type="submit" class="btn-submit">
                    Soumettre mon avis
                </button>
            </form>
        </div>
        
        {{-- LISTE DES AVIS EXISTANTS --}}
        <h2 style="margin-top: 50px;">Toutes les évaluations ({{ $avis->count() }})</h2>
        <ul class="reviews-list">
            @forelse ($avis as $serviceAvis)
                <li class="review-item">
                    <div class="review-header">
                        <p>{{ $serviceAvis->auteur_nom ?? 'Anonyme' }}</p>
                        <div class="rating-stars">
                            @for ($i = 0; $i < 5; $i++)
                                <span style="color: {{ $i < $serviceAvis->note ? 'var(--star-color)' : '#ccc' }};">★</span>
                            @endfor
                        </div>
                    </div>
                    
                    <p class="comment">{{ $serviceAvis->commentaire }}</p>
                    <small>Publié le : {{ $serviceAvis->created_at->format('d/m/Y') }}</small>
                </li>
            @empty
                <li style="text-align: center; color: #6c757d; padding: 20px; background: #fff;">
                    Soyez le premier à donner votre avis sur ProLocAuto !
                </li>
            @endforelse
        </ul>

    </div>
</body>
</html>