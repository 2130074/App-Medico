<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

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
        'correo'
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
        'edad' => 'integer',
        'altura' => 'decimal:2',
        'peso' => 'decimal:2',
    ];
    
}
