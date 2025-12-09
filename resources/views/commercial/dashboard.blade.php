<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Commercial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <!-- Logo / Titre -->
                        <a href="#" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 text-lg">Espace Commercial</span>
                        </a>
                    </div>
                </div>
                <!-- Menu droite -->
                <div class="flex items-center space-x-3">
                    <span class="py-2 px-2 font-medium text-gray-500">
                        {{ Auth::guard('commercial')->user()->prenom }} {{ Auth::guard('commercial')->user()->nom }}
                    </span>
                    
                    <!-- Bouton Déconnexion -->
                    <form action="{{ route('commercial.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="py-2 px-4 bg-red-500 hover:bg-red-600 text-white rounded transition duration-300 text-sm">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <div class="max-w-6xl mx-auto mt-10 px-4">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="border-b border-gray-200 pb-4 mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Vos messages</h1>
            </div>
            
            <!-- Zone des messages -->
            <div class="space-y-4">
                <!-- Exemple d'affichage vide ou liste -->
                <div class="p-4 bg-gray-50 text-gray-500 rounded border border-gray-200 italic text-center">
                    Vous n'avez aucun nouveau message pour le moment.
                </div>
            </div>
        </div>
    </div>

</body>
</html>