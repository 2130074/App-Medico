<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'paciente_id',
        'cantidad',
        'total_pago',
        'fecha_hora',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

}
