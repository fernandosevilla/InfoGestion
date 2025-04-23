<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
        'extension',
        'departamento_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relaciones

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function avisosAtendidos()
    {
        return $this->hasMany(Aviso::class, 'usuario_atiende_id');
    }

    public function partesResponsables()
    {
        return $this->hasMany(ParteTrabajo::class, 'usuario_responsable_id');
    }

    public function tareas()
    {
        return $this->hasMany(TareaParte::class, 'usuario_id');
    }

    public function inventariosCreados()
    {
        return $this->hasMany(Inventario::class, 'tecnico_alta_id');
    }

    public function inventariosRevisados()
    {
        return $this->hasMany(Inventario::class, 'tecnico_revision_id');
    }
}
