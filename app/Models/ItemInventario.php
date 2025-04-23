<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemInventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventario_id',
        'contrato_id',
        'nombre',
        'tipo',
        'num_serie',
        'marca',
        'modelo',
        'fecha_compra',
        'fecha_fin_garantia',
        'foto',
        'observaciones',
    ];

    // Relaciones

    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function tareas()
    {
        return $this->hasMany(TareaParte::class);
    }
}
