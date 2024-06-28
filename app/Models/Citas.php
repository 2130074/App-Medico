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
        'id_paciente',
        'id_servicio' 
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i',
        'id_paciente' => 'integer',
        'id_servicio' => 'integer'
    ];

    public function paciente() {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function tipo_servicio() { 
        return $this->belongsTo(Servicio::class, 'id_servicio'); 
    }
}

