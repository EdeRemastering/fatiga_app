<?php
// app/Http/Controllers/ProductoController.php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

 
    public function create()
{
    return view('productos.create');
}

public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required',
        'precio' => 'required|numeric',
        'descripcion' => 'nullable',
    ]);

    Producto::create($request->all());

    return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
}

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
    public function indexCliente() {
        $productos = Producto::all();
        return view('productos.index_cliente', compact('productos'));
    }
}
