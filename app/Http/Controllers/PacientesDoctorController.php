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
        $productos = Producto::all();
        return view('detallesCita', compact('cita', 'productos'));
    }

    public function actualizarCita(Request $request, $id)
    {
        $cita = Citas::find($id);
        $cita->motivos = $request->input('motivos');
        $cita->fecha = $request->input('fecha');
        $cita->hora = $request->input('hora');
        $cita->medicamentos = implode(',', $request->input('medicamentos', []));
        $cita->estudios = $request->input('estudios');
        $cita->total = $request->input('total', 0); // Guarda el total, asegurando que no sea nulo
        $cita->save();

        $productos = $request->input('productos', []);
        $cantidades = $request->input('cantidades', []);

        foreach ($productos as $index => $producto_id) {
            if (!empty($producto_id) && isset($cantidades[$index]) && $cantidades[$index] > 0) {
                $producto = Producto::find($producto_id);
                if ($producto && $producto->cantidad >= $cantidades[$index]) {
                    $producto->cantidad -= $cantidades[$index];
                    $producto->save();
                }
            }
        }

        return redirect()->route('docPacientes', ['id' => $cita->id_paciente])->with('success', 'Cita actualizada correctamente.');
    }
}
