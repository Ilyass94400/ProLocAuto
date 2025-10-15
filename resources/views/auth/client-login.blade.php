<form method="POST" action="{{ route('login') }}">
	@csrf
	<input type="email" name "email" placeholder="Email" required>
	<input type="password" name="password" placeholder="Mot de passe" required>
	<button typ="submit">Se connecter</button>
</form>
