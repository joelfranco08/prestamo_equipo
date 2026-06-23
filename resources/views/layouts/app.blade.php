<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGE - SENA Centro Colombo Alemán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">📦 Gestión Equipos</a>
            <div class="navbar-nav">
                <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="nav-link text-white {{ request()->routeIs('equipos.*') ? 'active fw-bold' : '' }}" href="{{ route('equipos.index') }}">Equipos</a>
                <a class="nav-link text-white {{ request()->routeIs('prestamos.*') ? 'active fw-bold' : '' }}" href="{{ route('prestamos.index') }}">Préstamos</a>
                <a class="nav-link text-white {{ request()->routeIs('solicitantes.*') ? 'active fw-bold' : '' }}" href="{{ route('solicitantes.index') }}">Solicitantes</a>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
