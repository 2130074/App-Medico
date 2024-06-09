<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'motivos',
        'fechaHora',
        'id_paciente',
        'id_tipo_servicio'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'fechaHora' => 'datetime',
        'id_paciente' => 'integer',
        'id_tipo_servicio' => 'integer'
    ];
    
    public function paciente() {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }
    public function tipo_servicio(){
        return $this->belongsTo('App\Models\Tipo_servicio', 'id_tipo_servicio');
    }
}
