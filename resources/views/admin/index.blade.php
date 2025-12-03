<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Bienvenue Admin !</h1>
            <!-- J'ai mis 'admin.logout' pour que ça marche avec tes routes -->
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Se déconnecter</button>
            </form>
        </div>

        <!-- --- LE BOUTON AJOUTÉ --- -->
        <div class="mb-4">
            <a href="{{ route('admin.annonce.create') }}" class="btn btn-primary">
                + Aller vers la création d'annonce
            </a>
        </div>
        <!-- ------------------------ -->

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Vos Clients</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Entreprise</th>
                            <th>Téléphone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->nom }}</td>
                                <td>{{ $client->prenom }}</td>
                                <td>{{ $client->nomentreprise ?? 'Particulier' }}</td>
                                <td>{{ $client->telephone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>