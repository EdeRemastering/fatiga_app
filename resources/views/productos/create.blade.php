

@extends('layouts.app')


@section('content')
<!-- resources/views/productos/create.blade.php -->

<h2>Crear Nuevo Producto</h2>
<form action="{{ route('productos.store') }}" method="POST">
    @csrf
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required><br>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion"></textarea><br>

    <label for="precio">Precio:</label>
    <input type="number" name="precio" required id="precio" min="0" step="1" oninput="checkMaxLength(this)" />

<script>
    function checkMaxLength(input) {
        if (input.value.length > 10) {
            input.value = input.value.slice(0, 10); // Limita a 10 dígitos
        }
    }
</script>
    <button type="submit" class="btn btn-danger">Crear Producto</button>
</form>
  
@endsection

