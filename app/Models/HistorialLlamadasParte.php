<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialLlamadasParte extends Model
{
    use HasFactory;

    protected $table = 'historial_llamadas_parte';

    protected $fillable = [
        'parte_trabajo_id',
        'fecha',
        'detalle',
    ];

    // Relaciones

    public function parteTrabajo()
    {
        return $this->belongsTo(ParteTrabajo::class);
    }
}
