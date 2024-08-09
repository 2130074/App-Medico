<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Citas extends Model
{
    use HasFactory;

    protected $fillable = [
        'motivos',
        'fecha',
        'hora',
        'estado',
        'id_paciente',
        'id_servicio',
        'medicamentos',
        'estudios',
        'productos',
        'total',
        'temperatura',
        'presion_arterial',
        'diagnostico'
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i',
        'id_paciente' => 'integer',
        'id_servicio' => 'integer',
        'productos' => 'array',  // Asegúrate de que los productos estén en formato array
    ];

    public function getFormattedHoraAttribute()
    {
        return Carbon::parse($this->hora)->format('H:i');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function tipo_servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }

     // Relación con Servicio
     public function servicio()
     {
         return $this->belongsTo(Servicio::class, 'id_servicio');
     }
}
