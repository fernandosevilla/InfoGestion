<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'pvp',
        'familia',
    ];

    // Relaciones

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

    public function materiales()
    {
        return $this->hasMany(MaterialUtilizado::class);
    }
}
