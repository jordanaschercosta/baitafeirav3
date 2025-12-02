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

        <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
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
                                    <li>
                                        <a class="nav-link position-relative" href="{{ route('notificacoes.index') }}"><i class="fas fa-bell i-fix"></i> &nbsp;&nbsp;&nbsp;
                                            <span id="notification-badge" style="display: none" class="badge bg-primary-subtle text-primary-emphasis rounded-pill badge-fix"></span>
                                        </a>
                                    </li>
                                    <li><a class="nav-link" href="{{ route('eventos.index') }}"><i class="far fa-calendar"></i> Meus Eventos</a></li>
                                    @if (!isUserOrganizador())
                                        <li><a class="nav-link" href="{{ route('favoritos.index') }}"><i class="far fa-heart"></i> Favoritos</a></li>
                                    @endif
                                    @if (isUserExpositor())
                                        <li><a class="nav-link" href="{{ route('bancas.index') }}"><i class="fas fa-store"></i> Bancas</a></li>
                                    @endif
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ session('user_email') }}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li class="dropdown-header">{{ Str::ucfirst(session('user.tipo')) }}</li>
                                            <li><a class="dropdown-item" href="{{ route('minha.conta') }}">Minha Conta</a></li>
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

        <footer class="bg-light text-center text-lg-start mt-5 border-top">
            <div class="container p-4">

                <!-- Texto -->
                <div class="text-center mb-3">
                    <p class="mb-0">Siga-nos nas redes sociais</p>
                </div>

                <!-- Ícones sociais -->
                <div class="text-center">
                    <!-- Instagram -->
                    <a href="https://instagram.com/seu_instagram" target="_blank" 
                    class="btn btn-outline-dark btn-sm rounded-circle me-2">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <!-- Facebook -->
                    <a href="https://facebook.com/seu_facebook" target="_blank" 
                    class="btn btn-outline-dark btn-sm rounded-circle">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                </div>

            </div>

            <!-- Copyright -->
            <div class="text-center py-3 bg-light">
                <small>&copy; {{ date('Y') }} Sua Marca. Todos os direitos reservados.</small>
            </div>
        </footer>

        <!-- JS global -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

        <script src="{{ asset('assets/app.js') }}" defer></script>
    </body>
</html>
