<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citas;
use App\Models\Producto;
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFController extends Controller
{
    public function generatePDF($citaId)
    {
        // Obtener la cita con la relación del paciente, servicio y enfermera
        $cita = Citas::with(['paciente', 'servicio', 'enfermera'])->findOrFail($citaId);

        // Decodificar los datos JSON
        $medicamentos = json_decode($cita->medicamentos, true) ?? [];
        $productos = json_decode($cita->productos, true) ?? [];

        // Obtener información de los productos
        $productosInfo = Producto::whereIn('id', array_column($productos, 'id'))->get()->keyBy('id');

        // Preparar los datos para la vista
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

        // Configurar opciones (por ejemplo, tamaño del papel)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Generar HTML para el PDF
        $html = view('pdf.cita', $data)->render();

        // Cargar HTML al Dompdf
        $dompdf->loadHtml($html);

        // (Opcional) Configurar tamaño y orientación del papel
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar el PDF
        $dompdf->render();

        // Obtener el nombre del archivo basado en el nombre del paciente y la fecha de la cita
        $nombrePaciente = $cita->paciente->nombre ?? 'Paciente';
        $fechaCita = $cita->fecha->format('d-m-Y');
        $nombreArchivo = "Cita_{$nombrePaciente}_{$fechaCita}.pdf";

        // Enviar el PDF al navegador con el nombre personalizado
        return $dompdf->stream($nombreArchivo);
    }
}
