<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    // Relaciones

    public function usuarios()
    {
        return $this->hasMany(User::class); // Porque usamos la tabla users
    }
}
