<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enfermera extends Model
{
    protected $table = 'enfermeras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_completo', 'sueldo',
    ];
}

