<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return view('users.index', compact('users'));
        } catch (QueryException $e) {
            // Capturar errores relacionados con la base de datos
            return back()->with('error', 'Error al cargar los usuarios: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('users.create');
        } catch (\Exception $e) {
            // Capturar cualquier otro tipo de error
            return back()->with('error', 'Error al cargar el formulario de creación: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Validar los datos recibidos del formulario
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'telefono' => 'nullable',
                'direccion' => 'nullable',
                'rol' => 'required|in:admin,repartidor,cliente',
            ]);

            // Crear el nuevo usuario
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->telefono = $request->telefono;
            $user->direccion = $request->direccion;
            $user->rol = $request->rol;
            $user->save();

            // Redirigir con un mensaje de éxito
            return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
        } catch (QueryException $e) {
            // Capturar errores relacionados con la base de datos
            return back()->with('error', 'Error al crear el usuario: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Capturar cualquier otro tipo de error
            return back()->with('error', 'Error inesperado: ' . $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        try {
            return view('users.edit', compact('user'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cargar el formulario de edición: ' . $e->getMessage());
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            // Validar los datos recibidos
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'telefono' => 'nullable',
                'direccion' => 'nullable',
                'rol' => 'required|in:admin,repartidor,cliente',
            ]);

            // Actualizar el usuario
            $user->update($request->all());

            // Redirigir con un mensaje de éxito
            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
        } catch (QueryException $e) {
            // Capturar errores relacionados con la base de datos
            return back()->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Capturar cualquier otro tipo de error
            return back()->with('error', 'Error inesperado: ' . $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            // Eliminar el usuario
            $user->delete();

            // Redirigir con un mensaje de éxito
            return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
        } catch (QueryException $e) {
            // Capturar errores relacionados con la base de datos
            return back()->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Capturar cualquier otro tipo de error
            return back()->with('error', 'Error inesperado: ' . $e->getMessage());
        }
    }
}
