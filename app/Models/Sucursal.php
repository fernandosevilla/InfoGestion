<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'nombre',
        'direccion',
        'telefono',
        'poblacion',
        'provincia',
    ];

    // Relaciones

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
