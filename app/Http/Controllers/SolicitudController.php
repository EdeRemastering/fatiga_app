<?php
// app/Http/Controllers/SolicitudController.php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::with('producto', 'user')->get();
        return view('solicitudes.index', compact('solicitudes'));
    }

    public function edit(Solicitud $solicitud)
    {
        $productos = Producto::all();
        $users = User::all();
        return view('solicitudes.edit', compact('solicitud', 'productos', 'users'));
    }

    public function update(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'user_id' => 'required|exists:users,id',
            'cantidad' => 'required|integer',
            'estado' => 'required|in:pendiente,entregado',
        ]);

        $solicitud->update($request->all());

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada correctamente');
    }

    public function destroy(Solicitud $solicitud)
    {
        $solicitud->delete();

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada correctamente');
    }
}
