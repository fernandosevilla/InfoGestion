<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaParte extends Model
{
    use HasFactory;

    protected $fillable = [
        'parte_trabajo_id',
        'trabajador_id',
        'item_inventario_id',
        'duracion',
        'detalle',
        'ubicacion',
    ];

    // Relaciones

    public function parteTrabajo()
    {
        return $this->belongsTo(ParteTrabajo::class);
    }

    public function trabajador()
    {
        return $this->belongsTo(User::class);
    }

    public function itemInventario()
    {
        return $this->belongsTo(ItemInventario::class);
    }
}
