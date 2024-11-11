<?php
// app/Http/Controllers/ProductoController.php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        try {
            $productos = Producto::all();
            return view('productos.index', compact('productos'));
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Hubo un problema al cargar los productos: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('productos.create');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Hubo un problema al cargar el formulario de creación: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'precio' => 'required|numeric',
                'descripcion' => 'nullable',
                'imagen' => 'nullable|image|mimes:jpg,jpeg,png', // Validación para la imagen
            ]);

      
            $rutaImagen = null;

            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                // Guardar directamente en public/imagenes_productos
                $imagen->move(public_path('imagenes_productos'), $nombreImagen);
                // Guardar solo la ruta relativa
                $rutaImagen = 'imagenes_productos/' . $nombreImagen;
            }

            Producto::create([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'descripcion' => $request->descripcion,
                'imagen' => $rutaImagen,
            ]);

            return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('productos.create')->with('error', 'Hubo un problema al crear el producto: ' . $e->getMessage());
        }
    }

    public function edit(Producto $producto)
    {
        try {
            return view('productos.edit', compact('producto'));
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Hubo un problema al cargar el formulario de edición: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Producto $producto)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'precio' => 'required|numeric',
                'descripcion' => 'nullable',
                'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validación de imagen
            ]);

            if ($request->hasFile('imagen')) {
                // Guardar la nueva imagen y actualizar la ruta
                $rutaImagen = $request->file('imagen')->store('public/imagenes_productos');
                $producto->ruta_imagen = str_replace('public/', 'storage/', $rutaImagen);
            }

            $producto->nombre = $request->nombre;
            $producto->precio = $request->precio;
            $producto->descripcion = $request->descripcion;
            $producto->save();

            return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('productos.edit', $producto->id)->with('error', 'Hubo un problema al actualizar el producto: ' . $e->getMessage());
        }
    }

    public function destroy(Producto $producto)
    {
        try {
            $producto->delete();
            return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Hubo un problema al eliminar el producto: ' . $e->getMessage());
        }
    }

    public function indexCliente()
    {
        try {
            $productos = Producto::all();
            return view('productos.index_cliente', compact('productos'));
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Hubo un problema al cargar los productos para el cliente: ' . $e->getMessage());
        }
    }
}
