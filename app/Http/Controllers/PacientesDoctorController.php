<?php


namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Citas;
use Illuminate\Http\Request;

class PacientesDoctorController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();
        return view('docPacientes', compact('pacientes'));
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
        $cita = Citas::findOrFail($id);
        return view('detallesCita', compact('cita'));
    }

    public function actualizarCita(Request $request, $id)
    {
        $request->validate([
            'motivos' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'estudios' => 'nullable|string',
            'medicamentos' => 'nullable|array',
            'medicamentos.*' => 'nullable|string',
        ]);

        $cita = Citas::findOrFail($id);
        $cita->motivos = $request->input('motivos');
        $cita->fecha = $request->input('fecha');
        $cita->hora = $request->input('hora');
        $cita->estudios = $request->input('estudios');
        $cita->medicamentos = $request->has('medicamentos') ? implode(',', $request->input('medicamentos')) : null;
        $cita->save();

        return redirect()->route('docPacientes');
    }
}
