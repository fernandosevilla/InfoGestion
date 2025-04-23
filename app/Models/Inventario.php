<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'nombre',
        'fecha_alta',
        'fecha_revision',
        'trabajador_alta_id',
        'trabajador_revision_id',
    ];

    // Relaciones

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function items()
    {
        return $this->hasMany(ItemInventario::class);
    }

    public function trabajadorAlta()
    {
        return $this->belongsTo(User::class, 'trabajador_alta_id');
    }

    public function trabajadorRevision()
    {
        return $this->belongsTo(User::class, 'trabajador_revision_id');
    }
}
