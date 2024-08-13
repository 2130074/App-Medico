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
        'enfermera_id',
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
        'productos' => 'array',
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

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }

    public function enfermera()
    {
        return $this->belongsTo(Enfermera::class, 'enfermera_id');
    }
}
