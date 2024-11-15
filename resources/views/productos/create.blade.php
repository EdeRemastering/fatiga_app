@extends('layouts.app')

@section('content')
<!-- resources/views/productos/create.blade.php -->
<div class="contenedor-principal">
    <div class="contenedor-secundario">

        <h2>Crear Nuevo Producto</h2>
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group two-columns">
                <label for="imagen">Imagen del Producto:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*"><br>
            </div>

            <div class="form-group"> <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required><br>
            </div>

            <div class="form-group"> <label for="precio">Precio:</label>
                <input type="number" name="precio" required id="precio" min="0" step="1" oninput="checkMaxLength(this)"><br>
            </div>

            <div class="form-group two-columns">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion"></textarea><br>
            </div>


            <script>
                function checkMaxLength(input) {
                    if (input.value.length > 10) {
                        input.value = input.value.slice(0, 10); // Limita a 10 dígitos
                    }
                }
            </script>

            <div class="form-group two-columns btn-container">
                <button type="submit" class="btn btn-danger">Crear Producto</button>
            </div>
        </form>

    </div>
</div>
@endsection