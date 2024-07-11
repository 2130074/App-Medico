<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Paciente;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function create()
    {
        $productos = Producto::all();
        $pacientes = Paciente::all();
        return view('recepcionista.vender', compact('productos', 'pacientes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_producto' => 'required|exists:productos,id',
            'nombre_paciente' => 'required',
            'fecha_hora' => 'required|date',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::find($request->nombre_producto);

        if ($request->cantidad > $producto->cantidad) {
            return redirect()->back()->withErrors(['cantidad' => 'La cantidad solicitada supera el stock disponible.']);
        }

        $totalPagoCalculado = $producto->costo * $request->cantidad;

        Venta::create([
            'producto_id' => $request->nombre_producto,
            'paciente_id' => $request->nombre_paciente,
            'fecha_hora' => $request->fecha_hora,
            'cantidad' => $request->cantidad,
            'total_pago' => $totalPagoCalculado,
        ]);
        
        $producto->update(['cantidad' => $producto->cantidad - $request->cantidad]);   
        return redirect()->route('Productos')->with('success', 'Venta registrada con éxito');
    }

    public function obtenerMaxStock($id)
    {
        $producto = Producto::findOrFail($id);
        return response()->json(['maxStock' => $producto->cantidad]);
    }
}
