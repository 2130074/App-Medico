<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Citas;
use App\Models\Producto;
use App\Models\Enfermera;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacientesDoctorController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with(['citas' => function ($query) {
            $query->where('fecha', '>=', now())->orderBy('fecha')->orderBy('hora');
        }])->get();

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
        $enfermeras = Enfermera::all();
        $doctores = Doctor::all();  // Aquí obtienes la lista de doctores

        return view('detallesCita', compact('cita', 'productos', 'servicio', 'enfermeras', 'doctores'));
    }


    public function actualizarCita(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'motivos' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required',
            'temperatura' => 'nullable|numeric',
            'presion_arterial' => 'nullable|string|max:255',
            'diagnostico' => 'nullable|string',
            // Validaciones para los datos del paciente
            'edad' => 'nullable|integer|min:0',
            'genero' => 'nullable|string|max:255',
            'altura' => 'nullable|numeric|min:0',
            'peso' => 'nullable|numeric|min:0',
            'enfermedades' => 'nullable|string|max:255',
            'alergias' => 'nullable|string|max:255',
            // Validaciones para enfermera
            'enfermera_id' => 'nullable|exists:enfermeras,id',
            // Validaciones para medicamentos, estudios y total
            'medicamentos' => 'nullable|array',
            'estudios' => 'nullable|array',
            'productos' => 'nullable|array',
            'productos.*' => 'exists:productos,id',
            'cantidades' => 'nullable|array',
            'cantidades.*' => 'integer|min:1',
            'total' => 'nullable|numeric',
        ]);

        // Buscar la cita por ID
        $cita = Citas::findOrFail($id);

        // Formatear medicamentos
        $medicamentos = $request->input('medicamentos', []);
        $medicamentosData = [];
        if (is_array($medicamentos)) {
            foreach ($medicamentos as $index => $medicamento) {
                $medicamentosData[] = [
                    'nombre' => $medicamento['nombre'] ?? '',
                    'dosis' => $medicamento['dosis'] ?? '',
                    'frecuencia' => $medicamento['frecuencia'] ?? '',
                    'duracion' => $medicamento['duracion'] ?? ''
                ];
            }
        }

        // Actualizar los datos de la cita
        $cita->update([
            'motivos' => $request->input('motivos'),
            'fecha' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'temperatura' => $request->input('temperatura'),
            'presion_arterial' => $request->input('presion_arterial'),
            'diagnostico' => $request->input('diagnostico'),
            'enfermera_id' => $request->input('enfermera_id'),
            'medicamentos' => !empty($medicamentosData) ? json_encode($medicamentosData, JSON_UNESCAPED_UNICODE) : null,
            'estudios' => implode(',', $request->input('estudios', [])),
            'total' => $request->input('total', 0),
        ]);

        // Actualizar los datos del paciente
        $paciente = $cita->paciente;
        $paciente->update([
            'edad' => $request->input('edad'),
            'genero' => $request->input('genero'),
            'altura' => $request->input('altura'),
            'peso' => $request->input('peso'),
            'enfermedades' => $request->input('enfermedades'),
            'alergias' => $request->input('alergias'),
        ]);

        $medicamentos = [];
        if ($request->has('medicamentos')) {
            foreach ($request->medicamentos as $index => $medicamento) {
                $medicamentos[] = [
                    'medicamento' => $medicamento,
                    'dosis' => $request->dosis[$index] ?? '',
                    'frecuencia' => $request->frecuencia[$index] ?? '',
                    'duracion' => $request->duracion[$index] ?? '',
                ];
            }
        }
        $cita->medicamentos = json_encode($medicamentos);

        // Procesa los productos
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

        $cita->productos = json_encode($productosData, JSON_UNESCAPED_UNICODE);
        $cita->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('detallesCita', ['id' => $cita->id])->with('success', 'Cita actualizada correctamente.');
    }

    public function mostrarDoctores()
    {
        $doctores = Doctor::all(); 
        return view('detallesCita', compact('doctores'));
    }
}
