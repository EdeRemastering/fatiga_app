 @extends('layouts.app')


@section('content')

<div class="container mt-5">
        <h2>Crear Nuevo Usuario</h2>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
        </div>

            <div class="form-group">
                <label for="rol">Rol:</label>
                <select class="form-control" id="rol" name="rol" required>
                    <option value="admin">Administrador</option>
                    <option value="repartidor">Repartidor</option>
                    <option value="cliente">Cliente</option>

                </select>
            </div>

            <button type="submit" class="btn btn-danger">Crear Usuario</button>
        </form>
    </div>

  
@endsection
