<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    protected $casts = [
        'fecha_hora' => 'datetime',
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
