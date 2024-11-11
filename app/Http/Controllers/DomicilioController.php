<?php

namespace App\Http\Controllers;

use App\Models\Domicilio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;  // Para registrar los errores

class DomicilioController extends Controller
{
    public function index()
    {
        try {
            $pendientes = Domicilio::with('user')->where('estado', 'pendiente')->get();
            $enCamino = Domicilio::with('user')->where('estado', 'en camino')->get();
            $entregados = Domicilio::with('user')->where('estado', 'entregado')->get();

            $repartidores = User::where('rol', 'repartidor')->get();
            return view('domicilios.index', compact('pendientes', 'enCamino', 'entregados', 'repartidores'));

        } catch (\Exception $e) {
            return redirect()->route('domicilios.index')->with('error', 'Hubo un error al cargar los domicilios: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'producto_id' => 'required|exists:productos,id',
                'direccion_destino' => 'required|string',
            ]);

            // Crear un nuevo domicilio
            $domicilio = new Domicilio();
            $domicilio->producto_id = $request->producto_id;
            $domicilio->user_id = Auth::user()->id;
            $domicilio->direccion_destino = $request->direccion_destino;
            $domicilio->estado = 'pendiente'; // Estado inicial
            $domicilio->save();

            return redirect()->route('domicilios.index_cliente')->with('success', 'Domicilio creado correctamente');

        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al crear el domicilio: ' . $e->getMessage());
        }
    }

    public function edit(Domicilio $domicilio)
    {
        try {
            $users = User::all();
            return view('domicilios.edit', compact('domicilio', 'users'));

        } catch (\Exception $e) {
            return redirect()->route('domicilios.index')->with('error', 'Hubo un error al cargar los datos para editar: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Domicilio $domicilio)
    {
        try {
            $request->validate([
                'repartidor_id' => 'nullable|exists:users,id',
            ]);

            // Actualizar el domicilio con el repartidor y establecer estado a "en camino"
            $domicilio->estado = 'en camino';
            $domicilio->repartidor_id = $request->repartidor_id; // Asigna el repartidor
            $domicilio->update();

            return redirect()->route('domicilios.index')->with('success', 'Domicilio actualizado correctamente');

        } catch (\Exception $e) {
            return redirect()->route('domicilios.index')->with('error', 'Hubo un error al actualizar el domicilio: ' . $e->getMessage());
        }
    }

    public function destroy(Domicilio $domicilio)
    {
        try {
            $domicilio->delete();

            return redirect()->route('domicilios.index')->with('success', 'Domicilio eliminado correctamente');

        } catch (\Exception $e) {
            return redirect()->route('domicilios.index')->with('error', 'Hubo un error al eliminar el domicilio: ' . $e->getMessage());
        }
    }

    public function indexCliente()
    {
        try {
            $domicilios = Domicilio::where('user_id', Auth::user()->id)->get();
            $repartidores = User::where('rol', 'repartidor')->get();

            return view('domicilios.index_cliente', compact('domicilios', 'repartidores'));

        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Hubo un error al cargar tus domicilios: ' . $e->getMessage());
        }
    }
    public function indexRepartidor()
    {
        try {
            // Obtener solo los domicilios que han sido asignados al repartidor logueado
            $pendientes = Domicilio::where('estado', 'pendiente')
                ->where('repartidor_id', Auth::user()->id)
                ->get();
    
            $entregados = Domicilio::where('estado', 'entregado')
                ->where('repartidor_id', Auth::user()->id)
                ->get();
    
            return view('domicilios.index_repartidor', compact('pendientes', 'entregados'));
        } catch (\Exception $e) {
            return redirect()->route('domicilios.index')->with('error', 'Hubo un error al cargar tus domicilios: ' . $e->getMessage());
        }
    }
    
    
    public function marcarEntregado(Domicilio $domicilio)
    {
        try {
            // Asegúrate de que el domicilio sea del repartidor logueado y esté pendiente
            if ($domicilio->repartidor_id != Auth::user()->id) {
                return redirect()->route('domicilios.index')->with('error', 'No tienes permiso para actualizar este domicilio.');
            }
    
            if ($domicilio->estado !== 'pendiente') {
                return redirect()->route('domicilios.index')->with('error', 'Este domicilio no está pendiente.');
            }
    
            // Actualiza el estado a "entregado"
            $domicilio->estado = 'entregado';
            $domicilio->save();
    
            return redirect()->route('domicilios.indexRepartidor')->with('success', 'Domicilio marcado como entregado.');
        } catch (\Exception $e) {
            return redirect()->route('domicilios.indexRepartidor')->with('error', 'Hubo un error al actualizar el domicilio: ' . $e->getMessage());
        }
    }
    
    
}
