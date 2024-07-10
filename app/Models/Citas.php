<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'total'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i',
        'id_paciente' => 'integer',
        'id_servicio' => 'integer',
        'productos' => 'array',
    ];

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

    public function citas()
    {
        return $this->belongsToMany(Citas::class, 'id_producto');
    }
}
