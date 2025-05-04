<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'trabajador_atiende_id',
        'detalle',
        'fecha_creacion',
        'nombre_cliente_nuevo',
        'nif_cliente_nuevo',
        'direccion_cliente_nuevo',
        'telefono_cliente_nuevo',
        'email_cliente_nuevo',
    ];

    // Relaciones

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function atendidoPor()
    {
        return $this->belongsTo(User::class, 'trabajador_atiende_id');
    }

    public function parteTrabajo()
    {
        return $this->hasOne(ParteTrabajo::class);
    }
}
