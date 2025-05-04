<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'agrupacion',
        'articulo_id',
    ];

    // Relaciones

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }
}
