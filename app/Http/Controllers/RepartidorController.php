<?php
namespace App\Http\Controllers;

use App\Models\Repartidor;
use App\Models\Domicilio; // Asegúrate de tener este modelo
use Illuminate\Http\Request;

class RepartidorController extends Controller
{
    // Mostrar todos los repartidores
    public function index()
    {
        // Obtener todos los repartidores
        $repartidores = Repartidor::where('rol', 'repartidor')->get();
    
        // Agregar el estado de cada repartidor (Libre u Ocupado)
        foreach ($repartidores as $repartidor) {
            // Buscar los domicilios asociados al repartidor
            $domicilios = Domicilio::where('repartidor_id', $repartidor->id)
                                   ->whereIn('estado', ['pendiente', 'en camino']) // Buscar solo domicilios pendientes o en camino
                                   ->get();

            // Si el repartidor tiene domicilios pendientes o en camino, está ocupado
            if ($domicilios->count() > 0) {
                $repartidor->estado = 'Ocupado';
            } else {
                $repartidor->estado = 'Libre'; // Si no tiene domicilios en estado pendiente o en camino, está libre
            }
        }
    
        // Pasar los repartidores con su estado a la vista
        return view('repartidores.index', compact('repartidores'));
    }
    
    // Mostrar el detalle de un repartidor específico
    public function show($id)
    {
        $repartidor = Repartidor::findOrFail($id);
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
