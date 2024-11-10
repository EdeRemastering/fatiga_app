<!-- resources/views/productos/index.blade.php -->
@extends('layouts.app')


@section('content')

<h2>Gestión de Productos</h2>
<a href="{{ route('productos.create') }}" class="btn btn-danger mb-3">Crear Producto</a>
<table id="productosTable" class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->descripcion }}</td>
            <td>${{ $producto->precio }}</td>
            <td>
                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-danger"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="mensajeDeEliminacion(event, '{{ $producto->id }}', '{{ $producto->nombre }}', 'Productos')"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

  
@endsection
