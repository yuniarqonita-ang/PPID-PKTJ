<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url={{ route('permohonan.gateway') }}">
    <title>Mengalihkan ke Portal Permohonan PPID PKTJ...</title>
</head>
<body>
    <script>
        window.location.href = "{{ route('permohonan.gateway') }}";
    </script>
</body>
</html>
