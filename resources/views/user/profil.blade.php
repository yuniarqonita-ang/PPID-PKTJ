<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil PPID</title>
</head>
<body>
    <header>
        <h1>Profil PPID</h1>
    </header>
    <main>
        <h2>{{ $profil->title }}</h2>
        <p>{{ $profil->content }}</p>
        @if($profil->file_path)
            <a href="{{ asset('storage/' . $profil->file_path) }}" target="_blank">Download File</a>
        @endif
    </main>
</body>
</html>