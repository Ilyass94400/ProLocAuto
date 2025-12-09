<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Annonces</title>
    <!-- On charge Bootstrap pour le style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container">
    
    <!-- En-tête avec bouton retour vers l'accueil -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestion des Annonces</h1>
        <a href="{{ route('admin.home') }}" class="btn btn-secondary">← Retour Clients</a>
    </div>

    <!-- 1. LE FORMULAIRE INTELLIGENT (CRÉATION OU MODIFICATION) -->
    <!-- Si la variable $annonceodia existe, on est en mode MODIFICATION (Jaune) -->
    <!-- Sinon, on est en mode CRÉATION (Bleu) -->
    <div class="card shadow-sm mb-5 border-{{ isset($annonceodia) ? 'warning' : 'primary' }}">
        <div class="card-header {{ isset($annonceodia) ? 'bg-warning text-dark' : 'bg-primary text-white' }}">
            <h5 class="mb-0">
                @if(isset($annonceodia))
                    ✏️ Modifier l'annonce : {{ $annonceodia->titre }}
                @else
                    ➕ Créer une nouvelle annonce
                @endif
            </h5>
        </div>
        <div class="card-body">
            <!-- L'action du formulaire change dynamiquement : UPDATE ou STORE -->
            <form action="{{ isset($annonceodia) ? route('admin.annonce.update', $annonceodia->id) : route('admin.annonce.store') }}" method="POST">
                @csrf
                
                <!-- Si on modifie, on doit ajouter la méthode PUT pour Laravel -->
                @if(isset($annonceodia))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <!-- Champ TITRE -->
                    <div class="col-md-4">
                        <label class="form-label">Titre</label>
                        <!-- On pré-remplit le champ avec l'ancienne valeur si elle existe -->
                        <input type="text" name="titre" class="form-control" 
                               value="{{ $annonceodia->titre ?? '' }}" required>
                    </div>

                    <!-- Champ PRIX -->
                    <div class="col-md-2">
                        <label class="form-label">Prix (€)</label>
                        <input type="number" name="prix" class="form-control" 
                               value="{{ $annonceodia->prix ?? '' }}" required>
                    </div>

                    <!-- Champ TYPE (Menu déroulant) -->
                    <div class="col-md-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select" required>
                            @php $currentType = $annonceodia->type ?? ''; @endphp
                            <!-- On sélectionne automatiquement l'option qui correspond à l'annonce -->
                            <option value="Type 1" {{ $currentType == 'Type 1' ? 'selected' : '' }}>Type 1 (Débutant)</option>
                            <option value="Type 2" {{ $currentType == 'Type 2' ? 'selected' : '' }}>Type 2 (Pro)</option>
                            <option value="Type 3" {{ $currentType == 'Type 3' ? 'selected' : '' }}>Type 3 (Illimité)</option>
                        </select>
                    </div>

                    <!-- Bouton VALIDER -->
                    <div class="col-md-3 align-self-end">
                        <button type="submit" class="btn w-100 {{ isset($annonceodia) ? 'btn-warning' : 'btn-success' }}">
                            {{ isset($annonceodia) ? 'Mettre à jour' : 'Publier' }}
                        </button>
                        
                        <!-- Bouton ANNULER (visible seulement en mode modification) -->
                        @if(isset($annonceodia))
                            <a href="{{ route('admin.annonces.manage') }}" class="btn btn-link text-muted btn-sm w-100 mt-1">Annuler la modification</a>
                        @endif
                    </div>

                    <!-- Champ DESCRIPTION -->
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="2" required>{{ $annonceodia->description ?? '' }}</textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. LA LISTE DES ANNONCES EXISTANTES (EN DESSOUS) -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            Liste des annonces existantes
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Type</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($annonces as $annonce)
                    <!-- Si on est en train de modifier cette ligne précise, on la met en jaune -->
                    <tr class="{{ (isset($annonceodia) && $annonceodia->id == $annonce->id) ? 'table-warning' : '' }}">
                        <td>{{ $annonce->titre }}</td>
                        <td><span class="badge bg-secondary">{{ $annonce->type }}</span></td>
                        <td>{{ $annonce->prix }} €</td>
                        <td>
                            <div class="d-flex gap-2">
                                <!-- BOUTON MODIFIER : Recharge cette page en mode édition -->
                                <a href="{{ route('admin.annonces.edit_mode', $annonce->id) }}" class="btn btn-sm btn-outline-warning text-dark">
                                    Modifier
                                </a>

                                <!-- BOUTON SUPPRIMER -->
                                <form action="{{ route('admin.annonce.delete', $annonce->id) }}" method="POST" onsubmit="return confirm('Supprimer ?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-3 text-muted">Aucune annonce. Utilisez le formulaire au-dessus pour en créer une.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>