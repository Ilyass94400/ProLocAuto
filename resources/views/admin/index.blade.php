<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

    <div class="container">
        
        <!-- EN-TÊTE -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1>Bienvenue Admin !</h1>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Se déconnecter</button>
            </form>
        </div>

        <!-- MESSAGES SUCCÈS (pour afficher les confirmations) -->
        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- BOUTONS D'ACTION -->
        <div class="mb-4 text-end d-flex gap-2 justify-content-end">
            <!-- Bouton Annonces (Bleu) -->
            <a href="{{ route('admin.annonces.manage') }}" class="btn btn-primary shadow-sm">
                ✏️ Annonces
            </a>

            <!-- Bouton Réservation (Vert) -->
            <a href="{{ route('admin.reservation.page') }}" class="btn btn-success shadow-sm">
                📅 Réservations
            </a>

            <!-- Bouton Commerciaux (Info) -->
            <a href="{{ route('admin.commercial.create') }}" class="btn btn-info text-white shadow-sm">
                👥 Commerciaux
            </a>
        </div>

        <!-- TABLEAU DES UTILISATEURS INSCRITS -->
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Utilisateurs Inscrits (Site Web)</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom complet</th>
                            <th>Email</th>
                            <th>Inscrit le</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- On boucle sur la variable $users envoyée par le contrôleur -->
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td class="fw-bold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <!-- On formate la date pour que ce soit joli (d/m/Y) -->
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>