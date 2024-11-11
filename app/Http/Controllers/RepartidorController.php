<?php

namespace App\Http\Controllers;

use App\Models\Repartidor;
use App\Models\Solicitud;

use Illuminate\Http\Request;

class RepartidorController extends Controller
{
    // Mostrar todos los repartidoresuse App\Models\Repartidor;
    public function index()
    {
        // Obtener todos los repartidores que tienen el rol de 'repartidor'
        $repartidores = Repartidor::where('rol', 'repartidor')->get();
    
        // Agregar el estado de cada repartidor (Libre u Ocupado)
        foreach ($repartidores as $repartidor) {
            // Buscar la última solicitud asociada al repartidor
            $solicitud = Solicitud::where('user_id', $repartidor->id)
                                  ->latest()
                                  ->first();
    
            // Si la solicitud está ocupada, marcar como ocupado, si no, libre
            $repartidor->estado = $solicitud && $solicitud->estado == 'en camino' ? 'Ocupado' : 'Libre';
        }
    
        // Pasar los repartidores con su estado a la vista
        return view('repartidores.index', compact('repartidores'));
    }
    
    // Mostrar el detalle de un repartidor específico
    public function show($id)
    {
        $repartidor = Repartidor::obtenerRepartidorPorId($id);
        return view('repartidores.show', compact('repartidor'));
    }

    // Función para actualizar la información de un repartidor
    public function update(Request $request, $id)
    {
        $repartidor = Repartidor::findOrFail($id);
        $repartidor->update($request->all());
        return redirect()->route('repartidores.index')->with('success', 'Repartidor actualizado correctamente');
    }

    // Función para eliminar un repartidor
    public function destroy($id)
    {
        $repartidor = Repartidor::findOrFail($id);
        $repartidor->delete();
        return redirect()->route('repartidores.index')->with('success', 'Repartidor eliminado correctamente');
    }
}
