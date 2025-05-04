<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialUtilizado extends Model
{
    use HasFactory;

    protected $fillable = [
        'parte_trabajo_id',
        'articulo_id',
        'cantidad',
        'detalle',
    ];

    // Relaciones

    public function parteTrabajo()
    {
        return $this->belongsTo(ParteTrabajo::class);
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
