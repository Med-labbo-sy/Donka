<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
</head>
<body>
    <h1>Liste des étudiants</h1>

    <ul>
        @foreach($students as $student)
            <li>{{ $student['name'] }}</li>
        @endforeach
    </ul>

    <a href="/">Accueil</a>
</body>
</html>