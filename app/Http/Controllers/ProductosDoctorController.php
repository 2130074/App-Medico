<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosDoctorController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('doc.docProductos', compact('productos'));
    }

    public function edit(Producto $producto)
    {
        return view('doc.modificarProductosDoc', compact('producto'));
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
        return redirect()->route('docProductos')->withSuccess("Producto actualizado exitosamente");
    }

    public function destroy(Producto $producto)
    {
        try {
            $producto->delete();
            return redirect()->route('docProductos')->withSuccess("Producto eliminado");
        } catch (\Exception $th) {
            return back()->withErrors(['error' => 'Hubo un problema al eliminar el servicio. Error: ' . $th->getMessage()]);
        }
    }

    public function store(StoreProductoRequest $request)
    {
        try {
            Producto::create($request->validated());
            return redirect()->route('docProductos')->with('success', 'Producto registrado correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Hubo un problema al insertar datos. Por favor, intentalo de nuevo']);
        }
    }
}
