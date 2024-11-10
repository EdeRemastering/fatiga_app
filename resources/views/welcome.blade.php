<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatiga</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="{{asset('js/storageTema.js')}}"></script>
</head>
<body>

    @if(session('success'))
        <script>mensajeDeExito("{{session('success')}}");</script>
    @endif
    
    @if(session('error'))
        <script>mensajeDeError("{{ session('error') }}");</script>
    @endif

    @if(session('warning'))
        <script>mensajeDeAdvertencia("{{ session('warning') }}");</script>
    @endif 

    <header>
        <h1>Bienvenidos a Fatiga</h1>
        <p>Disfruta de las mejores alitas, hamburguesas y platillos gourmet preparados con pasión y los ingredientes más frescos.</p>
    </header>

    <div class="card-container">
        <div class="card">
            <h2>Alitas de Pollo Especiales</h2>
            <p>Prueba nuestras deliciosas alitas de pollo con salsas únicas que te dejarán con ganas de más.</p>
        </div>

        <div class="card">
            <h2>Hamburguesas Gourmet</h2>
            <p>Disfruta de nuestras hamburguesas gourmet hechas con los mejores ingredientes y mucho sabor.</p>
        </div>

        <div class="card">
            <h2>Comida Mexicana Auténtica</h2>
            <p>Experimenta los auténticos sabores de la comida mexicana con nuestros tacos, burritos y más.</p>
        </div>

        <div class="card">
            <h2>Helados Artesanales</h2>
            <p>Termina tu comida con un delicioso helado artesanal, ideal para todos los gustos.</p>
        </div>
    </div>

    <div class="action-buttons">
            <a href="{{ route('login') }}" class="login">Iniciar Sesión</a>
    </div>

</body>
</html>
