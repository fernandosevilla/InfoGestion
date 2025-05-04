<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'razon_social',
        'nombre_comercial',
        'nif',
        'direccion_fiscal',
        'persona_contacto',
        'telefono_contacto',
        'poblacion',
        'provincia',
        'estado',
    ];

    // Relaciones

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class);
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }

    public function avisos()
    {
        return $this->hasMany(Aviso::class);
    }

    public function partesTrabajo()
    {
        return $this->hasMany(ParteTrabajo::class);
    }
}
