<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatiga</title>

    <!-- Favicon básico -->
    <link rel="icon" href="{{ asset('img/fatiga.png') }}" type="image/x-icon">

    @include('partials.estilos')
    @yield('estilos')
</head>
<body>

<header class="barra-navegacion">
    <div>

        <!-- Botón para alternar la barra lateral -->
        <button id="alternarBarraLateral" class="btn btn-light">☰</button>

        <!-- Botón para volver atrás -->
        <button class="btn btn-light" onclick="goBack()" aria-label="Volver atrás">
            <i class="bi bi-arrow-left"></i> <!-- Flecha hacia atrás de Bootstrap Icons -->
        </button>
    </div>
  

    <!-- Título dinámico -->
    <div><h2>@yield('titulo', 'Fatiga')</h2></div>
    
    <!-- Menú de perfil -->
    <div class="dropdown" style="position: relative;">
        <button class="btn btn-light dropdown-toggle" type="button" id="menuPerfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menuPerfil">
        <button class="dropdown-item">


        </button>
            <div class="dropdown-divider"></div>
            <button id="modoOscuroToggle" class="dropdown-item">Cambiar Tema <br> (experimental)</button>
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="dropdown-item">Cerrar Sesión</button>
            </form>
        </div>
    </div>
</header>

<!-- Barra lateral -->

<!-- Barra lateral -->
<div class="barra-lateral" id="barraLateral">
    <h2>
        <img class="icono-barra-lateral" src="{{ asset('img/fatiga.png') }}" style="width: 100px;" alt="Logo">
    </h2>

    <a href="{{ route('dashboard') }}" class="opcion-barra-navegacion {{ Request::is('*dashboard*') ? 'active' : '' }}">
        <i class="bi bi-house"></i> <span class="texto-barra-lateral">Inicio</span>
    </a>

    @if(Auth::user()->rol == 'admin')
        <!-- Enlaces para admin -->
        <a href="{{ route('users.index') }}" class="opcion-barra-navegacion {{ Request::is('*users*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> <span class="texto-barra-lateral">Usuarios</span>
        </a>

        <a href="{{ route('productos.index') }}" class="opcion-barra-navegacion {{ Request::is('*productos*') ? 'active' : '' }}">
            <i class="bi bi-cart-check"></i> <span class="texto-barra-lateral">Productos</span>
        </a>

        <a href="{{ route('domicilios.index') }}" class="opcion-barra-navegacion {{ Request::is('*domicilios*') ? 'active' : '' }}">
            <i class="bi bi-bicycle"></i> <span class="texto-barra-lateral">Domicilios</span>
        </a>

        <a href="{{ route('repartidores.index') }}" class="opcion-barra-navegacion {{ Request::is('*repartidores*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> <span class="texto-barra-lateral">Repartidores</span>
        </a>

        <a href="" class="opcion-barra-navegacion {{ Request::is('dd') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> <span class="texto-barra-lateral">Configuración</span>
        </a>
        @elseif(Auth::user()->rol == 'repartidor')
  

        <a href="{{ route('domicilios.index_repartidor') }}" class="opcion-barra-navegacion {{ Request::is('*domicilios*') ? 'active' : '' }}">
            <i class="bi bi-bicycle"></i> <span class="texto-barra-lateral">Domicilios</span>
        </a>

    @elseif(Auth::user()->rol == 'cliente')
        <!-- Enlaces para cliente -->
        <a href="{{ route('productos.index_cliente') }}" class="opcion-barra-navegacion {{ Request::is('*productos*') ? 'active' : '' }}">
            <i class="bi bi-cart-check"></i> <span class="texto-barra-lateral">Productos</span>
        </a>

        <a href="{{ route('domicilios.index_cliente') }}" class="opcion-barra-navegacion {{ Request::is('*domicilios*') ? 'active' : '' }}">
            <i class="bi bi-bicycle"></i> <span class="texto-barra-lateral">Domicilios</span>
        </a>

    @endif
</div>




<!-- Contenido principal -->
<section class="contenido" id="contenido">
    <div class="contenido-principal">

    <div class="seccionEstatus">
        @yield('estados')
   </div>
       @yield('content')

       @if(session('success'))
            <script>mensajeDeExito("{{session('success')}}");</script>
        @endif
        
        @if(session('error'))
            <script>mensajeDeError("{{ session('error') }}");</script>
        @endif

        @if(session('warning'))
            <script>mensajeDeAdvertencia("{{ session('warning') }}");</script>
        @endif 


    </div>
</section>

@include('partials.scripts')
<!-- Sección para incluir scripts adicionales en vistas específicas -->

@stack('scripts')
@yield('scripts')

</body>
</html>