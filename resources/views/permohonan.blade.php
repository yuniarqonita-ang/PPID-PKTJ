<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url={{ route('permohonan.form') }}">
    <title>Redirecting...</title>
</head>
<body>
    <p>Jika Anda tidak dialihkan secara otomatis, silakan klik <a href="{{ route('permohonan.form') }}">di sini</a>.</p>
    <script>
        window.location.href = "{{ route('permohonan.form') }}";
    </script>
</body>
</html>
