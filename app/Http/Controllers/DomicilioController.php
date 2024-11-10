<?php
// app/Http/Controllers/DomicilioController.php

namespace App\Http\Controllers;

use App\Models\Domicilio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DomicilioController extends Controller
{
    public function index()
{
    $pendientes = Domicilio::with('user')->where('estado', 'pendiente')->get();
    $enCamino = Domicilio::with('user')->where('estado', 'en camino')->get();
    $entregados = Domicilio::with('user')->where('estado', 'entregado')->get();

    $repartidores = User::where('rol', 'repartidor')->get();
    return view('domicilios.index', compact('pendientes', 'enCamino', 'entregados', 'repartidores'));
}

public function store(Request $request)
{
    $request->validate([
        'producto_id' => 'required|exists:productos,id',
        'direccion_destino' => 'required|string',
    ]);

    // Crear un nuevo domicilio
    $domicilio = new Domicilio();
    $domicilio->producto_id = $request->producto_id;
    $domicilio->direccion_destino = $request->direccion_destino;
    $domicilio->estado = 'pendiente'; // Estado inicial
    $domicilio->save();

    return redirect()->route('domicilios.index_cliente')->with('success', 'Domicilio creado correctamente');
}

    public function edit(Domicilio $domicilio)
    {
        $users = User::all();
        return view('domicilios.edit', compact('domicilio', 'users'));
    }

    public function update(Request $request, Domicilio $domicilio)
    {
        $request->validate([
            'user_id' => 'exists:users,id',
            'direccion_destino' => 'required',
            'estado' => 'required|in:pendiente,en camino,entregado',
            'repartidor_id' => 'nullable|exists:users,id'
        ]);
    
        try {
            $domicilio->update($request->all());
            return redirect()->route('domicilios.index')->with('success', 'Domicilio actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el domicilio: ' . $e->getMessage());
        }
    }
    

    public function destroy(Domicilio $domicilio)
    {
        $domicilio->delete();

        return redirect()->route('domicilios.index')->with('success', 'Domicilio eliminado correctamente');
    }

  
public function indexCliente()
{
    $domicilios = Domicilio::where('user_id', Auth::user()->id);
    return view('domicilios.index_cliente', compact('domicilios'));
}
}
