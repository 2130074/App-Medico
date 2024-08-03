<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Paciente extends Authenticatable
{
    use Notifiable;
    
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellidos',
        'edad',
        'genero',
        'altura',
        'peso',
        'enfermedades',
        'alergias',
        'telefono',
        'correo',
        'password',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'edad' => 'integer',
        'altura' => 'decimal:2',
        'peso' => 'decimal:2',
    ];

    public function citas()
    {
        return $this->hasMany(Citas::class, 'id_paciente');
    }
}
