<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Devis - ProLocAuto</title>
    <!-- Utilisation de Tailwind CSS pour un design propre (basé sur le thème bleu/gris) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #007bff;
            --background-light: #f4f7f6;
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--background-light); 
        }
    </style>
</head>
<body class="p-4 sm:p-8">
    <div class="max-w-3xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-2xl border-t-8 border-blue-600">
        
        @php
            // La logique clé : vérifie si un message 'success' est présent dans la session.
            $showSuccess = session('success');
        @endphp

        @if ($showSuccess)
            <!-- SECTION : MESSAGE DE SUCCÈS -->
            <div class="text-center py-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-20 w-20 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h1 class="text-3xl font-bold text-green-700 mt-4 mb-2">Demande Envoyée avec Succès !</h1>
                <p class="text-lg text-gray-600 mb-6">{{ $showSuccess }}</p>
                
                <div class="space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('devis.form') }}" class="inline-block w-full sm:w-auto py-3 px-6 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                        Faire une nouvelle demande
                    </a>
                    <a href="/" class="inline-block w-full sm:w-auto py-3 px-6 border border-gray-300 text-blue-600 font-semibold rounded-lg shadow-md hover:bg-gray-100 transition duration-200">
                        Retour à l'accueil
                    </a>
                </div>
            </div>

        @else
            <!-- SECTION : FORMULAIRE DE DEVIS (si pas de succès en session) -->
            <h1 class="text-3xl font-bold text-blue-700 mb-2">Demander un Devis d'Espace</h1>
            <p class="text-gray-600 mb-8">Remplissez ce formulaire. Un commercial vous contactera rapidement pour finaliser votre offre.</p>

            <!-- Affichage des erreurs de validation (si retour du POST avec des erreurs) -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <strong class="font-bold">Erreur de validation !</strong>
                    <ul class="mt-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('devis.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Nom Complet -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom Complet</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse E-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    </div>
                </div>

                <!-- Type de Bureau -->
                <div class="mb-6">
                    <label for="office_type" class="block text-sm font-medium text-gray-700 mb-1">Type d'Espace Souhaité</label>
                    <select id="office_type" name="office_type" required 
                            class="w-full p-3 border border-gray-300 bg-white rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                        <option value="">-- Sélectionnez un type --</option>
                        <option value="Bureau_Privé" {{ old('office_type') == 'Bureau_Privé' ? 'selected' : '' }}>Bureau Privé (1-4 personnes)</option>
                        <option value="Grand_Bureau" {{ old('office_type') == 'Grand_Bureau' ? 'selected' : '' }}>Grand Bureau (5+ personnes)</option>
                        <option value="Poste_Co_working" {{ old('office_type') == 'Poste_Co_working' ? 'selected' : '' }}>Poste Co-working</option>
                        <option value="Salle_Réunion" {{ old('office_type') == 'Salle_Réunion' ? 'selected' : '' }}>Location Salle de Réunion</option>
                    </select>
                </div>

                <!-- Détails de la Demande -->
                <div class="mb-8">
                    <label for="details" class="block text-sm font-medium text-gray-700 mb-1">Détails de votre demande (durée, nombre de personnes, besoins spécifiques)</label>
                    <textarea id="details" name="details" rows="4" required 
                              class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150">{{ old('details') }}</textarea>
                </div>

                <!-- Bouton de Soumission -->
                <button type="submit" 
                        class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200 uppercase">
                    Envoyer la Demande de Devis
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="/" class="text-blue-600 hover:underline">Retour à l'accueil ProLocAuto</a>
            </div>

        @endif
    </div>
</body>
</html>