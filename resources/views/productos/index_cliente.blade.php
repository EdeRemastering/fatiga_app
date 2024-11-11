@extends('layouts.app')

@section('content')
<div class="productos-container">
    @foreach($productos as $producto)
    <div class="card" style="display:flex; flex-direction: column; justify-content: center; align-items: center;">
        <h3 class="card-title" style="width: 100%">{{ $producto->nombre }}</h3>
        <img src="{{ asset('public/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="200">
        <p>{{ $producto->descripcion }}</p>
        <p><strong>Precio:</strong> ${{ $producto->precio }}</p>
        <button onclick="mostrarFormulario('{{ $producto->id }}')" class="btn btn-danger mb-3" style="width: fit-content;">Hacer Domicilio</button>
    </div>
    @endforeach
</div>

<div id="formularioDomicilio" style="display: none;">
    <h3>Formulario de Domicilio</h3>
    <form action="{{ route('domicilios.store') }}" method="POST">
        @csrf
        <input type="hidden" name="producto_id" id="producto_id">
        <label for="direccion_destino">Dirección de destino:</label>
        <input type="text" name="direccion_destino" id="direccion_destino" required>
        <button type="submit" class="btn btn-danger mb-3" style="width: fit-content;">Realizar Domicilio</button>
    </form>
</div>

<script>
    function mostrarFormulario(productoId) {
        document.getElementById('producto_id').value = productoId;
        document.getElementById('formularioDomicilio').style.display = 'block';
    }
</script>

@endsection

<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f9f9f9;
    }

    .card-title {
        background-color: red;
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
    }


    .btn:hover {
        background-color: #b30000;
    }

    .productos-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .card {
        width: 300px;
    }
</style>
