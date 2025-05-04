<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'servicio_id',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'dias_cortesia',
        'control_por_horas',
        'horas_contratadas',
        'factura_vinculada',
        'horas_restantes',
        'control_inventario',
        'baja',
        'fecha_baja',
        'observaciones_baja',
    ];

    // Relaciones

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function itemsInventario()
    {
        return $this->hasMany(ItemInventario::class);
    }

    public function partesTrabajo()
    {
        return $this->hasMany(ParteTrabajo::class);
    }
}
