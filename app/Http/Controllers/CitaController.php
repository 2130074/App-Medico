<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitaRequest;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Servicio;
use App\Models\Citas;
use App\Models\Venta;
use Carbon\Carbon;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Citas::with('servicio')->get();
        return view('recepcionista', [
            'pacientes' => Paciente::latest()->get(),
            'servicios' => Servicio::latest()->get(),
            'citas' => $citas,
        ]);
    }

    public function store(StoreCitaRequest $request)
    {
        $existingCita = Citas::where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->first();

        if ($existingCita) {
            return redirect()->route('recepcionista.index')
                ->with('error', 'Ya existe una cita registrada en la misma fecha y hora.');
        }

        Citas::create($request->validated());

        return redirect()->route('recepcionista.index')->with('success', 'Cita registrada correctamente');
    }


    public function verPago($paciente_id)
    {
        $citas = Citas::where('id_paciente', $paciente_id)
            ->with('tipo_servicio')
            ->get();

        return view('pago', compact('citas', 'paciente_id'));
    }

    public function cambiarEstadoPago(Request $request, $cita_id)
    {
        $cita = Citas::findOrFail($cita_id);
        $cita->estado = ($cita->estado == 'Pendiente') ? 'Pagado' : 'Pendiente';
        $cita->save();

        return redirect()->route('verPago', $request->paciente_id)->with('success', 'Estado del pago actualizado.');
    }

    public function ingresosDiarios()
    {
        $ventas = Venta::with(['paciente', 'producto'])->get();
        $citas = Citas::with(['paciente', 'servicio'])->get();

        $ingresos = [];

        foreach ($ventas as $venta) {
            $fecha = Carbon::parse($venta->fecha_hora)->format('Y-m-d');
            if (!isset($ingresos[$fecha])) {
                $ingresos[$fecha] = [
                    'ventas' => [],
                    'citas' => [],
                    'totalDiaVentas' => 0,
                    'totalDiaCitas' => 0,
                    'totalDia' => 0,
                ];
            }
            $ingresos[$fecha]['ventas'][] = $venta;
            $ingresos[$fecha]['totalDiaVentas'] += $venta->total_pago;
            $ingresos[$fecha]['totalDia'] += $venta->total_pago;
        }

        foreach ($citas as $cita) {
            $fecha = Carbon::parse($cita->fecha)->format('Y-m-d');
            if (!isset($ingresos[$fecha])) {
                $ingresos[$fecha] = [
                    'ventas' => [],
                    'citas' => [],
                    'totalDiaVentas' => 0,
                    'totalDiaCitas' => 0,
                    'totalDia' => 0,
                ];
            }
            $ingresos[$fecha]['citas'][] = $cita;
            $ingresos[$fecha]['totalDiaCitas'] += $cita->total;
            $ingresos[$fecha]['totalDia'] += $cita->total;
        }

        // Calcular totales generales
        $totalGeneralVentas = Venta::sum('total_pago');
        $totalGeneralCitas = Citas::sum('total');
        $totalGeneral = $totalGeneralVentas + $totalGeneralCitas;

        return view('doc.docIngresos', [
            'ingresos' => $ingresos,
            'totalGeneral' => $totalGeneral,
        ]);
    }
}
