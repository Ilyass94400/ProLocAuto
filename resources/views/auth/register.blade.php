<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h1>Créer un compte</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <label>Nom :</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br>
        @error('name') <span style="color:red;">{{ $message }}</span><br> @enderror

        <label>Email :</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br>
        @error('email') <span style="color:red;">{{ $message }}</span><br> @enderror

        <label>Mot de passe :</label><br>
        <input type="password" name="password"><br>
        @error('password') <span style="color:red;">{{ $message }}</span><br> @enderror

        <label>Confirmer le mot de passe :</label><br>
        <input type="password" name="password_confirmation"><br>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
