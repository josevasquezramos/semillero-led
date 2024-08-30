<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'fecha_nacimiento',
        'direccion',
        'telefono_emergencias',
    ];

    public function grupoAlumnos()
    {
        return $this->hasMany(GrupoAlumno::class);
    }

    public function grupoAlumno($grupoId)
    {
        return $this->grupoAlumnos()->where('grupo_id', $grupoId)->first();
    }

    public function apoderados()
    {
        return $this->hasMany(Apoderado::class);
    }

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'grupo_alumnos', 'alumno_id', 'grupo_id');
    }

    public function scopeSearch($query, $value)
    {
        $query->where('dni', 'like', "%{$value}%")
            ->orWhere('apellido_materno', 'like', "%{$value}%")
            ->orWhere('apellido_materno', 'like', "%{$value}%")
            ->orWhere('nombres', 'like', "%{$value}%");
    }
}
