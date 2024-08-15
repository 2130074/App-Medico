<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Citas;
use App\Models\Producto;
use App\Models\Notification;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DoctorColaboradorController extends Controller
{
    public function index()
    {
        $doctores = Doctor::all();
        return view('admin.DoctorColaborador', compact('doctores'));
    }

    public function registroDoctor(Request $request)
    {
        $doctor = new Doctor();
        $doctor->nombre_completo = $request->nombre_completo;
        $doctor->correo = $request->correo;
        $doctor->password = Hash::make($request->password);
        $doctor->telefono = $request->telefono;

        $doctor->save();

        return redirect()->route('DoctorColaborador.index')->with('success', 'Doctor registrado exitosamente.');
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        if ($doctor) {
            $doctor->delete();
            return redirect()->route('DoctorColaborador.index')
                ->with('success', 'Usuario eliminado exitosamente.');
        }
        return redirect()->route('DoctorColaborador.index')
            ->with('error', 'No se pudo encontrar el usuario.');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.modificarDoctor', compact('doctor'));
    }


    public function update(Request $request, $id)
    {
        $usuario = Doctor::findOrFail($id);

        $data = $request->validate([
            'nombre_completo' => 'required',
            'password' => 'nullable|string|min:4',
            'correo' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $usuario->update($data);

        return redirect()->route('DoctorColaborador.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function enviarOpinion(Request $request)
    {
        // Valida los datos
        $request->validate([
            'doctor_id' => 'required|exists:doctores,id',
            'mensaje' => 'required|string',
            'cita_id' => 'required|exists:citas,id',
        ]);

        // Obtener la cita
        $cita = Citas::with(['paciente', 'servicio', 'enfermera'])->findOrFail($request->input('cita_id'));

         // Decodificar los datos JSON
         $medicamentos = json_decode($cita->medicamentos, true) ?? [];
         $productos = json_decode($cita->productos, true) ?? [];
         
         // Obtener información de los productos
        $productosInfo = Producto::whereIn('id', array_column($productos, 'id'))->get()->keyBy('id');

        // Preparar los datos para la vista del PDF
        $data = [
            'titulo' => 'Salud Conecta',
            'subtitulo' => 'Detalles de la Cita',
            'paciente' => $cita->paciente,
            'servicio' => $cita->servicio->nombre ?? 'N/A',
            'precio_servicio' => $cita->servicio->precio ?? 'N/A',
            'motivo' => $cita->motivos,
            'fecha' => $cita->fecha->format('d/m/Y'),
            'hora' => $cita->hora->format('H:i'),
            'edad' => $cita->paciente->edad ?? 'N/A',
            'genero' => $cita->paciente->genero ?? 'N/A',
            'altura' => $cita->paciente->altura ?? 'N/A',
            'peso' => $cita->paciente->peso ?? 'N/A',
            'enfermedades' => $cita->paciente->enfermedades ?? 'N/A',
            'alergias' => $cita->paciente->alergias ?? 'N/A',
            'temperatura' => $cita->temperatura ?? 'N/A',
            'presion_arterial' => $cita->presion_arterial ?? 'N/A',
            'diagnostico' => $cita->diagnostico ?? 'N/A',
            'estudios' => explode(',', $cita->estudios),
            'medicamentos' => $medicamentos,
            'productos' => $productosInfo->map(function($producto) use ($productos) {
                $productoId = $producto->id;
                $cantidadTotal = collect($productos)
                    ->where('id', $productoId)
                    ->sum('cantidad');
                return [
                    'nombre' => $producto->nombre,
                    'cantidad' => $cantidadTotal
                ];
            }),
            'enfermera' => $cita->enfermera->nombre_completo ?? 'N/A',
            'sueldo_enfermera' => $cita->enfermera->sueldo ?? 'N/A',
            'precio_servicio' => $cita->servicio->precio ?? 'N/A',
            'total' => $cita->total,
        ];

        // Crear una nueva instancia de Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf.cita', $data)->render());

        // (Opcional) Configurar tamaño y orientación del papel
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar el PDF
        $dompdf->render();

        // Generar el nombre del archivo y la ruta
        $nombrePaciente = $cita->paciente->nombre ?? 'Paciente';
        $fechaCita = $cita->fecha->format('d-m-Y');
        $nombreArchivo = "Cita_{$nombrePaciente}_{$fechaCita}.pdf";
        $pdfPath = "public/{$nombreArchivo}";

        // Guardar el PDF en el sistema de archivos
        Storage::put($pdfPath, $dompdf->output());

        // Guardar la notificación en la base de datos con la ruta del PDF
        Notification::create([
            'doctor_id' => $request->input('doctor_id'),
            'message' => $request->input('mensaje'),
            'pdf_path' => Storage::url($pdfPath), // Guardar la URL accesible públicamente
        ]);

        return redirect()->back()->with('success', 'La opinión ha sido enviada al doctor seleccionado.');
    }

    public function mostrarInicioDocColab()
    {
        // Verificar si el usuario autenticado es un doctor
        $doctor = Auth::guard('doctor')->user();

        if (!$doctor) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para acceder a esta página.');
        }

        // Obtener las notificaciones del doctor autenticado
        $notificaciones = Notification::where('doctor_id', $doctor->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Pasar las notificaciones y el doctor a la vista
        return view('docColab.inicioDocColab', compact('doctor', 'notificaciones'));
    }
}
