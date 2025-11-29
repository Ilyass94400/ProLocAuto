<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Annonce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

<div class="container">
    <div class="card shadow-sm mx-auto" style="max-width: 800px;">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Nouvelle Offre de Location</h5>
            <a href="{{ route('admin.home') }}" class="btn btn-sm btn-light">Retour au Dashboard</a>
        </div>
        
        <div class="card-body">
            <form action="{{ route('admin.annonce.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Titre de l'annonce</label>
                    <input type="text" name="titre" class="form-control" placeholder="Ex: Bureau Paris 12" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Prix (€)</label>
                        <input type="number" name="prix" class="form-control" placeholder="150" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Type d'offre</label>
                        <select name="type" class="form-select" required>
                            <option value="Type 1">Type 1 (Débutant)</option>
                            <option value="Type 2">Type 2 (Pro)</option>
                            <option value="Type 3">Type 3 (Illimité)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2">Publier l'annonce</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>