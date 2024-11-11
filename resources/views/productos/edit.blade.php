@extends('layouts.app')

@section('content')
<!-- resources/views/productos/edit.blade.php -->
<div class="contenedor-principal">
    <div class="contenedor-secundario">

        <h2>Editar Producto</h2>
        <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
            <label for="imagen-anterior">Imagen actual</label>
                @if($producto->imagen)
                <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto" width="200"><br>
                @endif
            </div>
            <div class="form-group">
  

                <label for="imagen">Cambiar imagen del Producto:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*"><br>

            </div>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required><br>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" name="precio" value="{{ old('precio', $producto->precio) }}" required id="precio" min="0" step="1" oninput="checkMaxLength(this)"><br>
            </div>

            <div class="form-group two-columns">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea><br>
            </div>

            <script>
                function checkMaxLength(input) {
                    if (input.value.length > 10) {
                        input.value = input.value.slice(0, 10); // Limita a 10 dígitos
                    }
                }
            </script>

            <div class="form-group two-columns btn-container">
                <button type="submit" class="btn btn-danger">Actualizar Producto</button>
            </div>
        </form>

    </div>
</div>
@endsection