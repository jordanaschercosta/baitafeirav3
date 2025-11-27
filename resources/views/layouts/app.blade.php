<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Baita Feira -  Acompanhe eventos</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
        <header>
            @if (request()->route()->getName() <> 'login')
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container">
                        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" style="height: 75px;"></a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                @if(!empty(session('user_email')))
                                    <li><a class="nav-link px-3 py-2" href="{{ route('eventos.index') }}"><i class="fas fa-bell"></i> </a></li>
                                    <li><a class="nav-link" href="{{ route('eventos.index') }}"><i class="far fa-calendar"></i> Eventos</a></li>
                                    @if (isUserExpositor())
                                        <li><a class="nav-link" href="{{ route('bancas.index') }}"><i class="fas fa-store"></i> Bancas</a></li>
                                    @endif
                                    @if (isUserCliente())
                                        <li><a class="nav-link" href="#"><i class="far fa-heart"></i> Favoritos</a></li>
                                    @endif
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ session('user_email') }}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li class="dropdown-header">{{ session('user.tipo') }}</li>
                                            <li><a class="dropdown-item" href="#">Minha Conta</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="{{ route('logout') }}">Sair</a></li>
                                        </ul>
                                    </li>
                                @else
                                    <li><a class="nav-link" href="{{ route('login') }}">Entrar/Registrar</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
            @endif
        </header>
        <div class="container" id="main-container">
            <main>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        <footer class="text-center">
            <p>&copy; 2025 Meu App</p>
        </footer>

        <!-- JS global -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

        @vite('resources/js/app.js')
    </body>
</html>
