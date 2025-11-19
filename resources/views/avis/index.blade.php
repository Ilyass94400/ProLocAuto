<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avis sur notre Service</title>
    <style>
        body { font-family: sans-serif; margin: 40px; background-color: #f4f7f9; color: #333; }
        .container { max-width: 800px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        h1, h2 { color: #007bff; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px; margin-top: 30px; }
        .success-message { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .error-message { color: red; margin-bottom: 10px; }
        form { background: #f8f9fa; padding: 20px; border-radius: 6px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], input[type="number"], textarea { width: 98%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        textarea { resize: vertical; min-height: 100px; }
        button { background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; transition: background-color 0.3s ease; }
        button:hover { background-color: #0056b3; }
        .avis-item { border: 1px solid #e9ecef; padding: 15px; margin-bottom: 15px; border-radius: 4px; background: #fff; }
        .avis-item strong { display: inline-block; margin-right: 10px; color: #333; }
        .note { color: #ffc107; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h1>Avis sur notre Service et Site Web</h1>

    <!-- Affichage du message de succès après soumission -->
    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <h2>Laisser votre Avis</h2>

    <!-- Affichage des erreurs de validation -->
    @if ($errors->any())
        <div style="color: red; margin-bottom: 20px;">
            <p>Erreur(s) de validation :</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire de Soumission d'Avis -->
    <form method="POST" action="{{ route('avis.store') }}">
        @csrf <!-- Protection anti-CSRF, toujours obligatoire -->
        
        <label for="auteur_nom">Votre Nom :</label>
        <input type="text" name="auteur_nom" id="auteur_nom" value="{{ old('auteur_nom') }}" required>
        
        <label for="note">Note (1 à 5) :</label>
        <input type="number" name="note" id="note" min="1" max="5" value="{{ old('note', 5) }}" required>

        <label for="commentaire">Commentaire :</label>
        <textarea name="commentaire" id="commentaire" required>{{ old('commentaire') }}</textarea>

        <button type="submit">Soumettre l'Avis</button>
    </form>

    <hr>

    <h2>Avis Récents</h2>
    
    @forelse ($avis as $item)
        <div class="avis-item">
            <strong>{{ $item->auteur_nom }}</strong>
            - Note : <span class="note">{{ $item->note }}/5</span>
            <p>{{ $item->commentaire }}</p>
            <small>Soumis le {{ $item->created_at->format('d/m/Y à H:i') }}</small>
        </div>
    @empty
        <p>Aucun avis n'a encore été laissé sur notre service. Soyez le premier !</p>
    @endforelse
</div>

</body>
</html>
