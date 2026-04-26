<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Patient</title>
</head>
<body>

<h1>Bonjour {{ $user->name }} 🙋</h1>
<p>Email : {{ $user->email }}</p>
<p>Rôle : {{ $user->role }}</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Se déconnecter</button>
</form>

</body>
</html>