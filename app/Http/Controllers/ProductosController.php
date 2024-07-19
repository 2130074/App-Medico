<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('recepcionista.Productos', compact('productos'));
    }

    public function edit(Producto $producto)
    {
        return view('recepcionista.modificarProductos', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'marca' => 'required',
            'costo' => 'required|numeric',
            'cantidad' => 'required|integer',
        ]);

        $producto->update($validatedData);
        return redirect()->route('Productos')->withSuccess("Producto actualizado exitosamente");
    }

    public function store(StoreProductoRequest $request)
    {
        try {
            Producto::create($request->validated());
            return redirect()->route('Productos')->with('success', 'Producto registrado correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Hubo un problema al insertar datos. Por favor, intentalo de nuevo']);
        }
    }
}
