<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParteTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'aviso_id',
        'contrato_id',
        'trabajador_responsable_id',
        'solicitud',
        'estado',
        'fecha_creacion',
        'fecha_inicio',
        'fecha_fin',
        'ubicacion_finalizacion',
        'firma_trabajador',
        'firma_cliente',
        'email_enviado',
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

    public function aviso()
    {
        return $this->belongsTo(Aviso::class);
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'trabajador_responsable_id');
    }

    public function tareas()
    {
        return $this->hasMany(TareaParte::class);
    }

    public function materiales()
    {
        return $this->hasMany(MaterialUtilizado::class);
    }

    public function llamadas()
    {
        return $this->hasMany(HistorialLlamadasParte::class);
    }
}
