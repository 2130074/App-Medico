<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Citas;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacientesDoctorController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();
        return view('docPacientes', compact('pacientes'));
    }

    public function registerPatient(Request $request)
    {
        $paciente = new Paciente();

        $paciente->nombre = $request->nombre;
        $paciente->apellidos = $request->apellidos;
        $paciente->edad = $request->edad;
        $paciente->genero = $request->genero;
        $paciente->altura = $request->altura;
        $paciente->peso = $request->peso;
        $paciente->enfermedades = $request->enfermedades;
        $paciente->alergias = $request->alergias;
        $paciente->telefono = $request->telefono;
        $paciente->correo = $request->correo;
        $paciente->password = Hash::make($request->password);

        $paciente->save();

        return redirect(route('docPacientes'));
    }

    public function destroy(Paciente $paciente)
    {
        try {
            $paciente->delete();
            return redirect()->route('docPacientes')->withSuccess("Paciente eliminado");
        } catch (\Exception $th) {
            return back()->withErrors(['error' => 'Hubo un problema al eliminar el paciente. Error: ' . $th->getMessage()]);
        }
    }

    public function edit(Paciente $paciente)
    {
        return view('doc.modificarPacientesDoc', compact('paciente'));
    }

    public function update(Request $request, $id)
    {

        $paciente = Paciente::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
        ]);

        $paciente->fill($validatedData)->save();
        return redirect()->route('docPacientes')->with('success', 'Paciente actualizado exitosamente.');
    }

    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('detallesPacientes', compact('paciente'));
    }

    public function expediente($id)
    {
        $paciente = Paciente::findOrFail($id);
        $citas = Citas::where('id_paciente', $id)->get();
        return view('expediente', compact('paciente', 'citas'));
    }

    public function detallesCita($id)
    {
        $cita = Citas::with('tipo_servicio')->find($id);

        if (!$cita) {
            return redirect()->back()->with('error', 'Cita no encontrada.');
        }

        $productos = Producto::all();
        $servicio = $cita->tipo_servicio; 

        return view('detallesCita', compact('cita', 'productos', 'servicio'));
    }


    public function actualizarCita(Request $request, $id)
    {
        $cita = Citas::find($id);

        // Actualizar los campos de la cita
        $cita->motivos = $request->input('motivos');
        $cita->fecha = $request->input('fecha');
        $cita->hora = $request->input('hora');
        $cita->temperatura = $request->input('temperatura');
        $cita->presion_arterial = $request->input('presion_arterial');
        $cita->medicamentos = implode(',', $request->input('medicamentos', []));
        $cita->estudios = $request->input('estudios');
        $cita->total = $request->input('total', 0);

        // Guardar los productos y las cantidades como un array JSON
        $productos = $request->input('productos', []);
        $cantidades = $request->input('cantidades', []);
        $productosData = [];

        foreach ($productos as $index => $producto_id) {
            if (!empty($producto_id) && isset($cantidades[$index]) && $cantidades[$index] > 0) {
                $producto = Producto::find($producto_id);
                if ($producto && $producto->cantidad >= $cantidades[$index]) {
                    $producto->cantidad -= $cantidades[$index];
                    $producto->save();
                    $productosData[] = ['id' => $producto_id, 'cantidad' => (int)$cantidades[$index]];
                }
            }
        }

        $cita->productos = json_encode($productosData, JSON_UNESCAPED_UNICODE); // Guardar productos como JSON
        $cita->save();

        return redirect()->route('docPacientes', ['id' => $cita->id])->with('success', 'Cita actualizada correctamente.');
    }
}
