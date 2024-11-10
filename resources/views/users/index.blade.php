<!-- resources/views/users/index.blade.php -->

@extends('layouts.app')



@section('content')
    <h1>Usuarios</h1>
    <a href="{{ route('users.create') }}" class="btn btn-danger mb-3">Crear Usuario</a>

    <table id="usersTable" class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telefono }}</td>
                    <td>{{ $user->rol }}</td>
                    <td>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="mensajeDeEliminacion(event, '{{ $user->name }}', '{{ $user->email }}', 'Usuarios')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
