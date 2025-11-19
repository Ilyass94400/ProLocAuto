
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProLocAuto</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    
    <!-- HEADER AVEC LE LIEN AJOUTÉ -->
    <header class="bg-blue-600 text-white p-4 flex justify-between items-center">
        
        <!-- Titre/Logo principal -->
        <a href="{{ url('/') }}" class="text-2xl font-bold hover:text-gray-200 transition duration-150">ProLocAuto</a>
       
    </header>

    <main class="p-6">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white p-4 mt-6 text-center">
        © 2025 ProLocAuto
    </footer>
</body>
</html>
