 @extends('layouts.app')


@section('content')

<div class="contenedor-principal">


<div class="contenedor-secundario mt-5">
        <h2>Crear Nuevo Usuario</h2>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required maxlength="40">
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required maxlength="20">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="number" class="form-control" id="telefono" name="telefono" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required maxlength="40">
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required maxlength="20">
            </div>

            <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
        </div>

            <div class="form-group two-columns">
                <label for="rol">Rol:</label>
                <select class="form-control" id="rol" name="rol" required>
                    <option value="admin">Administrador</option>
                    <option value="repartidor">Repartidor</option>
                    <option value="cliente">Cliente</option>

                </select>
            </div>

            <div class="btn-container two-columns">
            <button type="submit" class="btn btn-danger">Crear Usuario</button>

            </div>
        </form>
    </div>

</div>
  
@endsection
